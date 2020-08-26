
<connectionStrings>
    <add name="CSDB" connectionString="data source=.; database=studentlist2; user=sa; password=123123; Integrated Security=False;" providerName="System.Data.SqlClient" />
</connectionStrings>

using System.Data.SqlClient;
using System.Configuration;
using System.Data;
string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;




config.Formatters.Remove(config.Formatters.XmlFormatter);
//config.Formatters.Remove(config.Formatters.JsonFormatter);

config.Formatters.JsonFormatter.SerializerSettings.Formatting =
               Newtonsoft.Json.Formatting.Indented;
config.Formatters.JsonFormatter.SerializerSettings.ContractResolver = 
new CamelCasePropertyNamesContractResolver();

//config.Formatters.JsonFormatter.SupportedMediaTypes.Add(new MediaTypeHeaderValue("text/html"));
config.Formatters.JsonFormatter.SupportedMediaTypes.Add(new MediaTypeHeaderValue("text/plain"));
config.Formatters.JsonFormatter.SupportedMediaTypes.Add(new MediaTypeHeaderValue("text/json"));


// Web API routes
config.MapHttpAttributeRoutes();
            