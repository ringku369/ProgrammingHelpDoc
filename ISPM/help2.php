<?php 



//Select======

string ch_query = @"select id from catseconds where catfirst_id = '" + _id + "'";
SqlDataReader rdr = BaseClass.ExecuteDataRdr(ch_query);

DataTable dt = new DataTable();
dt.Load(rdr);
int rowCount = dt.Rows.Count;
BaseClass.Con.Close();

//string name = dt.Rows[0]["name"].ToString();

if (rowCount > 0)
{
    error_area.Visible = true;
    success_area.Visible = false;
    error_msg.Text = "Data can not be deleted due to related with other data";
    return;
}

//Select======



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
string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
SqlConnection con = new SqlConnection(CS);
string query = @"select top 1 row_number() over (order by id) as row_number, id, name, code,username, 
serverip, password, remarks, port,
(case status when 0 then 'Inactive' else 'Active' end) as status,
convert(varchar(11),created_at,106) as created_at from ispnetworks where branch_id = '" + branch_id + "' order by id asc";
SqlCommand cmd = new SqlCommand(query, con);
con.Open();

SqlDataReader rdr = cmd.ExecuteReader();
Credential credential = new Credential();

if (rdr.HasRows)
{
    while (rdr.Read())
    {
        credential.tikConnectionType = TikConnectionType.Api;
        credential.name = rdr["name"].ToString();
        credential.code = rdr["code"].ToString();
        credential.host = rdr["serverip"].ToString();
        credential.port = Convert.ToInt32(rdr["port"].ToString());
        credential.username = rdr["username"].ToString();
        credential.password = rdr["password"].ToString();
        
    }
}

con.Close();
return credential;
//Select======


//Select======
string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
SqlConnection con14 = new SqlConnection(CS);

    string query14 = @"select id from proavamounts where product_id = '" + product_id + "' AND price = '" + price + "' ";
    SqlCommand cmd14 = new SqlCommand(query14, con14);
    con14.Open();
    SqlDataReader rdr14 = cmd14.ExecuteReader();

    if (rdr14.HasRows == false)
    {
        string query15 = @"insert into proavamounts (product_id,price)
                                    values (@product_id,@price)";
        SqlCommand cmd15 = BaseClass.CommandBuilder(query15);
        cmd15.Parameters.AddWithValue("@product_id", product_id);
        cmd15.Parameters.AddWithValue("@price", price);
        cmd15.ExecuteNonQuery();
        BaseClass.Con.Close();
    }

con14.Close();
//Select======



//Select======
string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
using (SqlConnection connection = new SqlConnection(CS))
{
   connection.Open();

   string query14 = @"select id from proavamounts where product_id = '" + product_id + "' AND price = '" + price + "' ";
   SqlCommand cmd14 = new SqlCommand(query14, connection);
   SqlDataReader rdr14 = cmd14.ExecuteReader();

   if (rdr14.HasRows == false)
   {
       string query15 = @"insert into proavamounts (product_id,price)
                               values (@product_id,@price)";
       SqlCommand cmd15 = BaseClass.CommandBuilder(query15);
       cmd15.Parameters.AddWithValue("@product_id", product_id);
       cmd15.Parameters.AddWithValue("@price", price);
       cmd15.ExecuteNonQuery();
       BaseClass.Con.Close();

   }

}
//Select======















//Select======
string chk_query = @"select * from ispclients where ispnetwork_id = '" + ispnetwork_id + "' and isRouter = 0";
SqlDataReader rdr1 = BaseClass.ExecuteDataRdr(chk_query);
while (rdr1.Read())
{
    int ispclient_id = Convert.ToInt32(rdr1["id"].ToString());
    string rusername = rdr1["rusername"].ToString();
    string rpassword = rdr1["rpassword"].ToString();
    string service = rdr1["service"].ToString();
    string profile = rdr1["profile"].ToString();
}
BaseClass.Con.Close();
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


//Update======
string query3 = @"update productsummaries set product_id = @product_id,
branch_id = branch_id where id = '" + _id + "'";
SqlCommand cmd3 = BaseClass.CommandBuilder(query3);
//cmd3.CommandType = System.Data.CommandType.StoredProcedure;
cmd3.Parameters.AddWithValue("@product_id", product_id);
cmd3.Parameters.AddWithValue("@branch_id", branch_id);
cmd3.ExecuteNonQuery();
BaseClass.Con.Close();
//Update======




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


string query5 = @"insert into ispclients (branch_id,ispnetwork_id,ispzone_id,ispsubzone_id,ispbox_id,
                        fullname,email,@password,rusername,rpassword,profile,service) 
                                                        values (@branch_id,@ispnetwork_id,@ispzone_id,@ispsubzone_id,@ispbox_id,
                        @fullname,@email,@password,@rusername,@rpassword,@profile,@service)";
                        SqlCommand cmd1 = BaseClass.CommandBuilder(query5);
                        cmd1.Parameters.AddWithValue("@branch_id", this._branch_id);
                        cmd1.Parameters.AddWithValue("@ispnetwork_id", ispnetwork_id);
                        cmd1.Parameters.AddWithValue("@ispzone_id", ispzone_id);
                        cmd1.Parameters.AddWithValue("@ispsubzone_id", ispsubzone_id);
                        cmd1.Parameters.AddWithValue("@ispbox_id", ispbox_id);
                        cmd1.Parameters.AddWithValue("@fullname", fullname);
                        cmd1.Parameters.AddWithValue("@email", email);
                        cmd1.Parameters.AddWithValue("@password", password);
                        cmd1.Parameters.AddWithValue("@rusername", rusername);
                        cmd1.Parameters.AddWithValue("@rpassword", rpassword);
                        cmd1.Parameters.AddWithValue("@profile", profile);
                        cmd1.Parameters.AddWithValue("@service", service);
                        cmd1.ExecuteNonQuery();
                        BaseClass.Con.Close();




//Update With Store Prcedure======
string query3 = @"TB_Stap_1";
SqlCommand cmd3 = BaseClass.CommandBuilder(query3);
cmd3.CommandType = System.Data.CommandType.StoredProcedure;
cmd3.Parameters.AddWithValue("@wid", warehouse_id);
cmd3.ExecuteNonQuery();
BaseClass.Con.Close();
//Update With Store Prcedure======

// Select With Store Prcedure ======
string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
SqlConnection con = new SqlConnection(CS);
con.Open();
string query = "TB_Stap_2";
SqlCommand cmd = new SqlCommand(query, con);
cmd.Parameters.AddWithValue("@wid", warehouse_id);
cmd.CommandType = CommandType.StoredProcedure;
SqlDataReader rdr = cmd.ExecuteReader();
GridView1.DataSource = rdr;
GridView1.DataBind();
con.Close();
//Select With Store Prcedure======