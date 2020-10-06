### To Know JWT-Athentication 

# https://codeburst.io/jwt-auth-in-asp-net-core-148fb72bed03

# https://www.c-sharpcorner.com/article/jwt-json-web-token-authentication-in-asp-net-core/

# https://code-maze.com/authentication-aspnetcore-jwt-1/

# https://code-maze.com/authentication-aspnetcore-jwt-2/


### To Know Details

# https://github.com/CuriousDrive/BookStores/blob/master/BookStoresWebAPI/BookStoresWebAPI/BookStoresWebAPI/Startup.cs


### Package Install

# Microsoft.EntityFrameworkCore.SqlServer
# Microsoft.EntityFrameworkCore.Tools
# Microsoft.AspNetCore.Mvc.NewtonsoftJson
# Microsoft.AspNetCore.Authentication.JwtBearer


### Add Connection Settings into appSettings.json file
"ConnectionStrings": {
	"ConnectionDB": "Server=.\\SQLEXPRESS;Database=studentlist;user=sa; password=123123;Trusted_Connection=True;"
}




### Scaffolding Command - 

Scaffold-DbContext "Server=DESKTOP-CR2CBO7\SQLEXPRESS;Database=studentlist;user=sa; password=123123;Trusted_Connection=True;" Microsoft.EntityFrameworkCore.SqlServer -OutputDir Models

Scaffold-DbContext "Server=.\SQLEXPRESS;Database=studentlist;user=sa; password=123123;Trusted_Connection=True;" Microsoft.EntityFrameworkCore.SqlServer -OutputDir Models -force


Scaffold-DbContext -Connection Name=ConnectionDB Microsoft.EntityFrameworkCore.SqlServer -OutputDir Models -force

studentlistContext _context = new studentlistContext();




public void ConfigureServices(IServiceCollection services)
{
	services.AddDbContext<studentlist1Context>(options =>
                                options.UseSqlServer(Configuration.GetConnectionString("ConnectionDB")));

    services.AddControllers();

    services.AddMvc(option => option.EnableEndpointRouting = false)
        .SetCompatibilityVersion(CompatibilityVersion.Version_3_0)
        .AddNewtonsoftJson(opt => opt.SerializerSettings.ReferenceLoopHandling = ReferenceLoopHandling.Ignore);

        

    //services.AddControllers()
    //    .AddNewtonsoftJson(options =>
    //    {
    //        options.SerializerSettings.Formatting = Formatting.Indented;
    //    });


    //services.AddMvc().AddJsonOptions(options =>
    //{
    //    options.JsonSerializerOptions.WriteIndented = true;
    //});


}

.AddJwtBearer(options => {           
    options.RequireHttpsMetadata = false;           
    options.SaveToken = true;           
    options.TokenValidationParameters = new TokenValidationParameters()         
    {               
    ValidateIssuer = true,              
    ValidIssuer = jwtBearerTokenSettings.Issuer,                
    ValidateAudience = true,                
    ValidAudience = jwtBearerTokenSettings.Audience,                
    ValidateIssuerSigningKey = true,                
    IssuerSigningKey = new SymmetricSecurityKey(key),               
    ValidateLifetime = true,                
    ClockSkew = TimeSpan.Zero           
    };      
});



eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjIwMzEiLCJyb2xlIjoiTWFuYWdlciIsIm5iZiI6MTYwMTg5OTYxOCwiZXhwIjoxNjAxODk5OTE4LCJpYXQiOjE2MDE4OTk2MTh9.3KJ21samB8G3WfeeO0kQFOvSFwpNFh3ioS6PhBVi6Cw

eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjIwMzEiLCJyb2xlIjoiTWFuYWdlciIsIm5iZiI6MTYwMTg5OTcwMCwiZXhwIjoxNjAxOTAwMDAwLCJpYXQiOjE2MDE4OTk3MDB9.7TIHNRMJZl386ZdkcYCUQZTeB1p7cBSj42KqeZBiBYg

eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjIwMzEiLCJyb2xlIjoiTWFuYWdlciIsIm5iZiI6MTYwMTg5OTcyNSwiZXhwIjoxNjAxOTAwMDI1LCJpYXQiOjE2MDE4OTk3MjV9.iwryFpmQIcFgBLZSNCdV5LG8pMEBtGOznsCh5sXUMiU

eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjIwMzEiLCJyb2xlIjoiTWFuYWdlciIsIm5iZiI6MTYwMTg5OTgxNiwiZXhwIjoxNjAxOTAwMTE2LCJpYXQiOjE2MDE4OTk4MTZ9.LtF3faoHdZTNlLI1HINGsCodWGJUvZH0zyAvFJyt41o

eyJhbGciOiJIUzI1NiIsInR5cCI6IkpXVCJ9.eyJ1bmlxdWVfbmFtZSI6IjIwMzEiLCJyb2xlIjoiTWFuYWdlciIsIm5iZiI6MTYwMTg5OTgzMywiZXhwIjoxNjAxOTAwMTMzLCJpYXQiOjE2MDE4OTk4MzN9.SPN2Xo_jhQ-E4dZJi7Wgtrm2FwedNBvsvCSunpFTl9o
