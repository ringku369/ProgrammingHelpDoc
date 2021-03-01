using System;
using System.Collections.Generic;
using System.Linq;
using System.Web;
using System.Web.UI;
using System.Web.UI.WebControls;

using System.Data.SqlClient;
using System.Configuration;
using System.Data;
using ISPM.Classes;

namespace ISPM
{
    public partial class SiteMaster : MasterPage
    {
        protected string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
        MyBaseClass BaseClass = new MyBaseClass();
        protected int _id;
        protected int _ulevel;
        protected int _branch_id;
        protected string _name;
        protected string _email;
        protected string _username;
        protected string _usertype;
        protected string _hostimage;
        protected string _companyimage;

        protected void Page_Load(object sender, EventArgs e)
        {

            if (!IsPostBack)
            {

                // Session checking...
                if (Session["UserID"] == null)
                {
                    Response.Write("User ID");
                    //Response.Redirect("Login.aspx");
                    return;
                }
                else
                {
                    int id = Convert.ToInt32(Session["UserID"]);

                    using (SqlConnection con = new SqlConnection(CS))
                    {
                        con.Open();
                        DataSet ds = new DataSet();
                        string query = @"select id, name, email,username, ulevel,branch_id,
                                            CASE
                                                WHEN ulevel > 10000 THEN 'Super Admin'
                                                WHEN ulevel > 1000 THEN 'Admin'
                                                ELSE 'Oparator'
                                            END AS usertype from
                                            users where id = @id";

                        SqlDataAdapter da = new SqlDataAdapter(query, con);

                        da.SelectCommand.Parameters.AddWithValue("@id", id);
                        da.Fill(ds);

                        this._id = Convert.ToInt32(ds.Tables[0].Rows[0]["id"]);
                        this._ulevel = Convert.ToInt32(ds.Tables[0].Rows[0]["ulevel"]);
                        this._branch_id = Convert.ToInt32(ds.Tables[0].Rows[0]["branch_id"]);

                        this._name = ds.Tables[0].Rows[0]["name"].ToString();
                        this._email = ds.Tables[0].Rows[0]["email"].ToString();
                        this._usertype = ds.Tables[0].Rows[0]["usertype"].ToString();
                        this._username = ds.Tables[0].Rows[0]["username"].ToString();

                        // for setting 

                        //DataSet ds1 = new DataSet();
                        //string query1 = @"select hostimage, companyimage from settings";

                        //SqlDataAdapter da1 = new SqlDataAdapter(query1, con);
                        //da1.Fill(ds1);

                        //this._hostimage = ds1.Tables[0].Rows[0]["hostimage"].ToString();
                        //this._companyimage = ds1.Tables[0].Rows[0]["companyimage"].ToString();


                        //Select branch======
                        string ch_query = @"select name, mobile, image, hotline, code from branches where id = '" + this._branch_id + "'";

                        SqlDataReader rdr = BaseClass.ExecuteDataRdr(ch_query);
                        DataTable dt = new DataTable();
                        dt.Load(rdr);
                        int rowCount = dt.Rows.Count;
                        BaseClass.Con.Close();

                        if (rowCount > 0)
                        {
                            this._companyimage = dt.Rows[0]["image"].ToString();

                            branchArea.Visible = true;
                            Label5.Text = dt.Rows[0]["name"].ToString() + " - " + dt.Rows[0]["code"].ToString();

                        }
                        else
                        {
                            branchArea.Visible = false;
                            Label5.Text = "";
                        }
                        //Select branch======




                    }

                    //Response.Write("ID Is " + this._ulevel);
                    //return;

                    if (this._ulevel == 100000)
                    {
                        Menu1.Visible = true;
                        Menu2.Visible = false;
                        Label1.Text = this._name;

                        Label2.Text = this._username;
                        Label3.Text = this._usertype;
                        Label4.Text = Session["LastLogin"].ToString();

                        Session["UserLevel"] = this._ulevel;

                        Image1.ImageUrl = "Assets/logo/logo1.png";
                        Image2.ImageUrl = "Assets/logo/logo2.png";
                        

                    }
                    else
                    {
                        Image1.ImageUrl = "Assets/logo/logo1.png";

                        if (this._companyimage != null)
                        {
                            Image2.ImageUrl = "Assets/Upload/" + this._companyimage;
                        }
                        else
                        {
                            Image2.ImageUrl = "Assets/logo/logo2.png";
                        }


                        Menu1.Visible = false;
                        Menu2.Visible = true;
                        Label1.Text = this._name;
                        Label2.Text = this._username;
                        Label3.Text = this._usertype;
                        Label4.Text = Session["LastLogin"].ToString();

                        Session["UserLevel"] = this._ulevel;

                        Session["Branch_ID"] = this._branch_id;




                        GetMenuItems();
                    }



                    Image3.ImageUrl = "Assets/images/iso_color.jpg";
                    Image4.ImageUrl = "Assets/images/trusted.png";




                }

                ////Restrictions=========
                //int days = (int)(new DateTime(2020, 7, 21) - DateTime.Now.Date).TotalDays;
                //if (days <= 0)
                //{
                //    Session.Clear();
                //    Response.Redirect("Unauthorized.aspx");
                //}
                ////Restrictions========= 

            }

        }


        //===================
        protected DataSet ExecuteDataSet(string query)
        {
            using (SqlConnection con = new SqlConnection(CS))
            {
                con.Open();
                SqlDataAdapter da = new SqlDataAdapter(query, con);
                DataSet ds = new DataSet();
                da.Fill(ds);

                return ds;
            }

        }


        protected void LinkButton1_Click(object sender, EventArgs e)
        {
            Session.Clear();
            Response.Redirect("Login.aspx");
        }

        public void GetMenuItems()
        {
            string query = @"select * from usermenus where user_id = '" + Session["UserID"] + "' AND status = 1 ";
            DataSet dsResult = ExecuteDataSet(query);

            foreach (DataRow level1DataRow in dsResult.Tables[0].Rows)
            {
                MenuItem parentItem = new MenuItem();
                parentItem.Text = level1DataRow["parent"].ToString();
                parentItem.Value = level1DataRow["parent"].ToString();
                parentItem.NavigateUrl = level1DataRow["nurl"].ToString();
                //parentItem.ImageUrl = level1DataRow["ImageURL"].ToString();

                foreach (MenuItem menu1Item in Menu1.Items)
                {
                    if (menu1Item.Value == parentItem.Value)
                    {
                        parentItem.ImageUrl = menu1Item.ImageUrl;
                    }

                }

                Menu2.Items.Add(parentItem);
                GetChildMenuItems(parentItem, level1DataRow["parent"].ToString());
            }
        }
        public void GetChildMenuItems(MenuItem parentItem, string parent)
        {
            string query = @"select * from usermenus where user_id = '" + Session["UserID"] + "' AND parent='" + parent + "' AND child<>parent";
            DataSet ds = ExecuteDataSet(query);

            if (ds.Tables[0].Rows.Count > 0)
            {
                foreach (DataRow level2DataRow in ds.Tables[0].Rows)
                {
                    MenuItem childItem = new MenuItem();
                    childItem.Text = " " + level2DataRow["child"].ToString().Trim();
                    //string mnvalue;
                    //mnvalue = level2DataRow["child"].ToString().Trim();
                    childItem.Value = level2DataRow["child"].ToString().Trim();
                    childItem.NavigateUrl = level2DataRow["nurl"].ToString().Trim();
                    childItem.ImageUrl = "Assets/images/arrow2.png";
                    parentItem.ChildItems.Add(childItem);

                    string query1 = @"select * from usermenus where user_id = '" + Session["UserID"] + "' AND parent='" + level2DataRow["child"].ToString() + "' AND status = 0";
                    DataSet ds1 = ExecuteDataSet(query1);
                    if (ds1.Tables[0].Rows.Count > 0)
                    {
                        //Response.Write(" Parent Irem Is : " + level2DataRow["child"].ToString());
                        GetChildMenuItems1(childItem, level2DataRow["child"].ToString());
                    }
                }
            }
        }


        public void GetChildMenuItems1(MenuItem parentItem, string parent)
        {
            string query = @"select * from usermenus where user_id = '" + Session["UserID"] + "' AND parent='" + parent + "' AND status = 0";
            DataSet ds = ExecuteDataSet(query);

            if (ds.Tables[0].Rows.Count > 0)
            {
                foreach (DataRow level2DataRow in ds.Tables[0].Rows)
                {
                    MenuItem childItem = new MenuItem();
                    childItem.Text = " " + level2DataRow["child"].ToString().Trim();
                    //string mnvalue;
                    //mnvalue = level2DataRow["child"].ToString().Trim();
                    childItem.Value = level2DataRow["child"].ToString().Trim();
                    childItem.NavigateUrl = level2DataRow["nurl"].ToString().Trim();
                    childItem.ImageUrl = "Assets/images/arrow2.png";
                    parentItem.ChildItems.Add(childItem);

                    string query1 = @"select * from usermenus where user_id = '" + Session["UserID"] + "' AND parent='" + level2DataRow["child"].ToString() + "' AND status = 0";
                    DataSet ds1 = ExecuteDataSet(query1);
                    if (ds1.Tables[0].Rows.Count > 0)
                    {
                        //Response.Write(" Parent Irem Is : " + level2DataRow["child"].ToString());
                        GetChildMenuItems1(childItem, level2DataRow["child"].ToString());
                    }

                }
            }
        }


        private void Check(MenuItem item)
        {
            //string rurl = Request.AppRelativeCurrentExecutionFilePath;

            //Response.Write("Value is : " + rurl.Substring(2) + "<br />");


            if (item.NavigateUrl.Equals(Request.AppRelativeCurrentExecutionFilePath.Substring(2),
                StringComparison.InvariantCultureIgnoreCase))
            {



                item.Selected = true;

                // selected child menu item
                MenuItem childItem = new MenuItem();

                childItem.Text = item.Parent.Text.ToString() + " => " + item.Text.ToString();

                childItem.Value = item.Value;
                childItem.NavigateUrl = item.NavigateUrl;
                childItem.ImageUrl = "Assets/images/arrow2.png";



                Menu3.Items.Add(childItem);

                if (Menu3.Items.Count > 1)
                {
                    Menu3.Items.Remove(Menu3.FindItem(childItem.Value));
                }



            }
            else if (item.ChildItems.Count > 0)
            {
                foreach (MenuItem menuItem in item.ChildItems)
                {
                    Check(menuItem);
                }
            }


        }


        private void Check1(MenuItem item)
        {
            if (item.NavigateUrl.Equals(Request.AppRelativeCurrentExecutionFilePath,
                StringComparison.InvariantCultureIgnoreCase))
            {

                //item.Selected = true;
                //item.Parent.Selected = true;

                // selected child menu item
                MenuItem childItem = new MenuItem();

                childItem.Text = item.Parent.Text.ToString() + " => " + item.Text.ToString();

                childItem.Value = item.Value;
                childItem.NavigateUrl = item.NavigateUrl;
                childItem.ImageUrl = "Assets/images/arrow2.png";
                Menu3.Items.Add(childItem);

            }
            else if (item.ChildItems.Count > 0)
            {
                foreach (MenuItem menuItem in item.ChildItems)
                {
                    Check(menuItem);
                }
            }


        }


        protected void Menu1_PreRender(object sender, EventArgs e)
        {
            foreach (MenuItem item in Menu1.Items)
            {
                Check(item);
            }
        }

        protected void Menu2_PreRender(object sender, EventArgs e)
        {
            foreach (MenuItem item in Menu2.Items)
            {
                Check(item);
            }
        }



        //protected void Menu1_MenuItemClick(object sender, MenuEventArgs e)
        //{
        //    ScriptManager.RegisterClientScriptBlock(sender as Control, this.GetType(), "alert", "alert('" + e.Item.Text + "')", true);
        //}

    }
}