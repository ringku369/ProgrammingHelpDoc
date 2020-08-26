<connectionStrings>
    <add name="CSDB" connectionString="data source=.; database=studentlist2; user=sa; password=123123; Integrated Security=False;" providerName="System.Data.SqlClient" />
</connectionStrings>

using System.Data.SqlClient;
using System.Configuration;
using System.Data;



protected string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
MyBaseClass BaseClass = new MyBaseClass();

//Select======

string query = @"select top 1000 row_number() over (order by id) as row_number, id, name_en, name_bn,code,
                convert(varchar(11),created_at,106) as created_at from catfirsts order by id desc";
SqlDataReader rdr = BaseClass.ExecuteDataRdr(query);

DataTable dt = new DataTable();
dt.Load(rdr);
BaseClass.Con.Close();
//int rowCount = dt.Rows.Count;

//string name = dt.Rows[0]["name"].ToString();

//Response.Write("Value is : " + rowCount);

GridView1.DataSource = dt;
GridView1.DataBind();

//Select======


//Select======
string ch_query = @"select top 1 id from branches order by id desc";
SqlDataReader rdr = BaseClass.ExecuteDataRdr(ch_query);
DataTable dt = new DataTable();
dt.Load(rdr);
int branch_id = Convert.ToInt32(dt.Rows[0]["id"]);
//int rowCount = dt.Rows.Count;

//string name = dt.Rows[0]["name"].ToString();
BaseClass.Con.Close();
//Select======

//Insert======
string query3 = @"insert into productsummaries (product_id,branch_id) 
    values (@product_id,@branch_id)";
SqlCommand cmd3 = BaseClass.CommandBuilder(query3);
//cmd3.CommandType = System.Data.CommandType.StoredProcedure;
cmd3.Parameters.AddWithValue("@product_id", product_id);
cmd3.Parameters.AddWithValue("@branch_id", branch_id);
cmd3.ExecuteNonQuery();
BaseClass.Con.Close();
//Insert======


//Delete======
string dlquery = @"delete from productsummaries where branch_id = '" + _id + "' ";
SqlCommand cmd3 = BaseClass.CommandBuilder(dlquery);
cmd3.ExecuteNonQuery();
BaseClass.Con.Close();
//Delete======

success_area.Visible = true;
error_area.Visible = false;
success_msg.Text = "Data inserted successfully";

error_area.Visible = true;
success_area.Visible = false;
error_msg.Text = "Data can not be deleted due to related with other data";