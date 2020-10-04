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
