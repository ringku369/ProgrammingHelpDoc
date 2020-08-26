using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

using System.Data.SqlClient;
using System.Configuration;
using System.Data;
using WebApplication1.Classes;

namespace WebApplication1
{
    public partial class WebForm3 : System.Web.UI.Page
    {
        protected string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;

        MyBaseClass BaseClass = new MyBaseClass();
        
        protected void Page_Load(object sender, EventArgs e)
        {

            
            

            if (!IsPostBack)
            {
                //update();
                DropDownList1.Items.Insert(0, new ListItem("Select Item", ""));

                //DropDownList2.Items.Clear();
                DropDownList2.Items.Insert(0, new ListItem("Select Item", ""));
                DropDownList3.Items.Insert(0, new ListItem("Select Item", ""));

                

                GetStudentData1();
                //GetStudentData2();



            }

        }

        protected void GetStudentData()
        {
            SqlConnection con = new SqlConnection(CS);
            string query = "select * from students";
            SqlCommand cmd = new SqlCommand(query, con);
            con.Open();

            SqlDataReader rdr = cmd.ExecuteReader();

            GridView1.DataSource = rdr;
            GridView1.DataBind();
            con.Close();

        }

        public void GetStudentData1()
        {
            
            string query = @"select * from students";
            SqlDataReader rdr = BaseClass.ExecuteDataRdr(query);

            DataTable dt = new DataTable();
            dt.Load(rdr);

            string name = dt.Rows[0]["name"].ToString();
            int rowCount = dt.Rows.Count;

            Response.Write("Value is : " + rowCount);

            GridView1.DataSource = dt;
            GridView1.DataBind();
            BaseClass.Con.Close();

        }

        public void GetStudentData2()
        {

            string query = @"select * from students";
            DataSet ds = BaseClass.ExecuteDataSet(query);

            string name = ds.Tables[0].Rows[0]["name"].ToString();
            int rowCount = ds.Tables[0].Rows.Count;

            Response.Write("Value is : " + rowCount);

            GridView1.DataSource = ds;
            GridView1.DataBind();
            BaseClass.Con.Close();

        }


        public void update()
        {
            string query = @"update students set name = @name where id = @id ";
            SqlCommand cmd = BaseClass.CommandBuilder(query);
            cmd.Parameters.AddWithValue("@name","Md.Sanaullah Ringku");
            cmd.Parameters.AddWithValue("@id", 39);
            int totalRow = cmd.ExecuteNonQuery();

            Response.Write("Total Row Affected : " + totalRow.ToString());


        }

        protected void DropDownList1_SelectedIndexChanged(object sender, EventArgs e)
        {
            DropDownList2.Items.Clear();
            DropDownList2.Items.Insert(0, new ListItem("Select Item", ""));
        }

        protected void DropDownList2_SelectedIndexChanged(object sender, EventArgs e)
        {
            DropDownList3.Items.Clear();
            DropDownList3.Items.Insert(0, new ListItem("Select Item", ""));
        }


        protected void BtnEdit_Click(object sender, EventArgs e)
        {
            int _id = Convert.ToInt32(((LinkButton)sender).CommandArgument);

            //Response.Write("Value is : " + _id);

            string query = @"select * from students where id = '"+ _id +"' ";
            SqlDataReader rdr = BaseClass.ExecuteDataRdr(query);

            DataTable dt = new DataTable();
            dt.Load(rdr);
            int numRows = dt.Rows.Count;

            TextBox1.Text = dt.Rows[0]["name"].ToString();
            TextBox2.Text = dt.Rows[0]["email"].ToString();
            TextBox3.Text = dt.Rows[0]["dob"].ToString();

            DropDownList1.SelectedValue = dt.Rows[0]["country_id"].ToString();
            //DropDownList2.SelectedValue = dt.Rows[0]["state_id"].ToString();
            //DropDownList3.SelectedValue = dt.Rows[0]["city_id"].ToString();
            

            //Response.Write("Value is : " + name);

        }

        protected void Button1_Click(object sender, EventArgs e)
        {
            int country_id = Convert.ToInt32(DropDownList1.SelectedValue);
            int state_id = Convert.ToInt32(DropDownList2.SelectedValue);
            int city_id = Convert.ToInt32(DropDownList3.SelectedValue);

            string name = TextBox1.Text.ToString();
            string email = TextBox2.Text.ToString();
            string dob = TextBox3.Text.ToString();

            string query = @"insert into students (name,email,country_id,state_id,city_id,dob) 
                                values (@name,@email,@country_id,@state_id,@city_id,@dob)";
            SqlCommand cmd = BaseClass.CommandBuilder(query);
            cmd.Parameters.AddWithValue("@name", name);
            cmd.Parameters.AddWithValue("@email", email);
            cmd.Parameters.AddWithValue("@country_id", country_id);
            cmd.Parameters.AddWithValue("@state_id", state_id);
            cmd.Parameters.AddWithValue("@city_id", city_id);
            cmd.Parameters.AddWithValue("@dob", dob);
            int totalRow = cmd.ExecuteNonQuery();

            Response.Write("Total Row Affected : " + totalRow.ToString());



        }




    }

   
}