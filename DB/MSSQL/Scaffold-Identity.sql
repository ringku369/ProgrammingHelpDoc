### To Know Identity-Athentication 

# https://www.codaffection.com/asp-net-core-article/asp-net-core-mvc-login-and-registration-with-identity/

### Package Install

# Microsoft.EntityFrameworkCore.SqlServer
# Microsoft.EntityFrameworkCore.Tools
# Microsoft.AspNetCore.Mvc.NewtonsoftJson
# Microsoft.AspNetCore.Authentication.JwtBearer

### ApplicationUser 
### AuthDbContext




### Add Connection Settings into appSettings.json file
"ConnectionStrings": {
	"ConnectionDB": "Server=.\\SQLEXPRESS;Database=studentlist;user=sa; password=123123;Trusted_Connection=True;"
}



public void ConfigureServices(IServiceCollection services)
{
    services.AddDbContext<AuthDbContext>(options =>
                        options.UseSqlServer(Configuration.GetConnectionString("AuthDbContextConnection")));


    services.AddControllersWithViews();
    services.AddRazorPages();
}

public void Configure(IApplicationBuilder app, IWebHostEnvironment env)
{
    if (env.IsDevelopment())
    {
        app.UseDeveloperExceptionPage();
    }
    else
    {
        app.UseExceptionHandler("/Home/Error");
    }
    app.UseStaticFiles();

    app.UseRouting();

    app.UseAuthentication();
    app.UseAuthorization();

    app.UseEndpoints(endpoints =>
    {
        endpoints.MapControllerRoute(
            name: "default",
            pattern: "{controller=Home}/{action=Index}/{id?}");
        //to be added
        endpoints.MapRazorPages();
    });
}


/Identity/Account/Login
/Identity/Account/Logout
/Identity/Account/Register


public class ApplicationUser : IdentityUser<Int32>
{
    [PersonalData]
    [Column(TypeName ="nvarchar(100)")]
    public string FirstName { get; set; }

    [PersonalData]
    [Column(TypeName = "nvarchar(100)")]
    public string LastName { get; set; }
}

public class AuthDbContext : IdentityDbContext<ApplicationUser, IdentityRole<Int32>,Int32>



Add-Migration "First-Migration" -context AuthDbContext
Update-Database -context AuthDbContext






### Scaffolding Command - 

Scaffold-DbContext "Server=DESKTOP-CR2CBO7\SQLEXPRESS;Database=studentlist;user=sa; password=123123;Trusted_Connection=True;" Microsoft.EntityFrameworkCore.SqlServer -OutputDir Models

Scaffold-DbContext "Server=.\SQLEXPRESS;Database=studentlist;user=sa; password=123123;Trusted_Connection=True;" Microsoft.EntityFrameworkCore.SqlServer -OutputDir Models -force


Scaffold-DbContext -Connection Name=ConnectionDB Microsoft.EntityFrameworkCore.SqlServer -OutputDir Models -force

studentlistContext _context = new studentlistContext();




