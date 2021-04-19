<?php

use ispm;

//Select======
SqlConnection con = new SqlConnection(CS);
string query = @"select top 1 row_number() over (order by id) as row_number, id, name, code,username, 
serverip, password, remarks, port,
(case status when 0 then 'Inactive' else 'Active' end) as status,
convert(varchar(11),created_at,106) as created_at from ispnetworks where branch_id = '" + branch_id + "' order by id asc";
SqlCommand cmd = new SqlCommand(query, con);
con.Open();

SqlDataReader rdr = cmd.ExecuteReader();
Credential credential = new Credential();
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
con.Close();
return credential;
//Select======

