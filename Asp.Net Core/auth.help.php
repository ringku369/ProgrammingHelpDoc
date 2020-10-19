<?php 

Startup 

public void Configure(IApplicationBuilder app, IWebHostEnvironment env)
        {
            if (env.IsDevelopment())
            {
                app.UseDeveloperExceptionPage();
            }
            app.Use(async (context, next) =>
            {
                var principal = new ClaimsPrincipal();
                var result1 = await context.AuthenticateAsync("Administrative");
                if (result1?.Principal != null)
                {
                    principal.AddIdentities(result1.Principal.Identities);
                }
                context.User = principal;
                await next();
            });
            

            app.UseRouting();

            app.UseAuthentication();

            app.UseAuthorization();

            app.UseSession();

            app.UseStaticFiles();

            app.UseEndpoints(endpoints =>
            {
                endpoints.MapControllerRoute(
                    name: "default",
                    pattern: "{controller=Login}/{action=Index}/{id?}");
            });
        }

Login Controller

using System;
using System.Collections.Generic;
using System.Linq;
using System.Threading.Tasks;
using AdministrativeModule.Models;
using AdministrativeModule.Security;
using Microsoft.AspNetCore.Mvc;

namespace AdministrativeModule.Controllers
{
    public class LoginController : Controller
    {
        private DatabaseContext db = new DatabaseContext();
        private SecurityManager securityManager = new SecurityManager();
        public LoginController(DatabaseContext _db)
        {
            db = _db;
        }
        public IActionResult Index()
        {
            return View();
        }
        [HttpPost]
        [Route("process")]
        public IActionResult Process(string userName, string password)
        {
            var employee = processLogin(userName, password);
            if (employee != null)
            {
                securityManager.SignIn(this.HttpContext, employee, "Administrative");
                return RedirectToAction("index", "dashboard");
            }
            else
            {
                ViewBag.error = "Username and Password not match...";
                return View("Index");
            }
        }
        private Users processLogin(string userName, string password)
        {
            var account = db.Users.SingleOrDefault(a => a.UserName.Equals(userName) && a.Password == password && a.Status == true);
            if (account != null)
            {
                return account;
            }
            return null;
        }
        [Route("signout")]
        public IActionResult SignOut()
        {
            securityManager.SignOut(this.HttpContext, "Administrative");
            return RedirectToAction("Index", "Login");
        }
    }
}

Securirty Manager

using AdministrativeModule.Models;
using Microsoft.AspNetCore.Authentication;
using Microsoft.AspNetCore.Http;
using System;
using System.Collections.Generic;
using System.Linq;
using System.Security.Claims;
using System.Threading.Tasks;

namespace AdministrativeModule.Security
{
    public class SecurityManager
    {
        public async void SignIn(HttpContext httpContext, Users users, string schema)
        {
            ClaimsIdentity claimsIdentity = new ClaimsIdentity(getUserClaims(users), schema);
            ClaimsPrincipal claimsPrincipal = new ClaimsPrincipal(claimsIdentity);
            await httpContext.SignInAsync(schema, claimsPrincipal);
        }
        public async void SignOut(HttpContext httpContext, string schema)
        {
            await httpContext.SignOutAsync(schema);
        }
        private IEnumerable<Claim> getUserClaims(Users users)
        {
            List<Claim> claims = new List<Claim>();
            claims.Add(new Claim(ClaimTypes.Name, users.UserName));
            claims.Add(new Claim("name", users.FirstName +" "+ users.LastName));
            users.RoleUsers.ToList().ForEach(ra =>
            {
                claims.Add(new Claim(ClaimTypes.Role, ra.Role.Name));
            });
            return claims;
        }
    }
}


