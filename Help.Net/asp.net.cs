
<connectionStrings>
    <add name="CSDB" connectionString="data source=.; database=studentlist2; user=sa; password=123123; Integrated Security=False;" providerName="System.Data.SqlClient" />
</connectionStrings>

using System.Data.SqlClient;
using System.Configuration;
using System.Data;



// DML Transaction Step
string CS = ConfigurationManager.ConnectionStrings["CSDB"].ConnectionString;
SqlConnection con = new SqlConnection(CS);
con.Open();
SqlTransaction trx = con.BeginTransaction(IsolationLevel.ReadCommitted);
try
{
    trx.Commit();
    con.Close();
}
catch (SqlException ex)
{
    trx.Rollback();

}
// DML Transaction Step



// checking relation with other table
    string query1 = @"select count(t1.id) as count from settings as t1";
    DataSet ds = ExecuteDataSet(query1);
    int rowcount = Convert.ToInt32(ds.Tables[0].Rows[0]["count"]);
// checking relation with other table



public void GetAutoIncrementID()
{
    string query = @"SELECT IDENT_CURRENT('users')";
    SqlDataReader rdr = BaseClass.ExecuteDataRdr(query);

    DataTable dt = new DataTable();
    dt.Load(rdr);
    int rowCount = dt.Rows.Count;
    int aiid = Convert.ToInt32(dt.Rows[0][0]) + 1;
    Response.Write("Value is : " + aiid);
}


protected void GetDataType1()
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        string query =
            "select t1.id as [City Id], t2.name as Country, t1.name as City from cities as t1 " +
            "join countries as t2 on t2.id = t1.country_id";

        SqlCommand cmd = new SqlCommand(query, con);
        con.Open();
        using (SqlDataReader rdr = cmd.ExecuteReader())
        {
            GridView1.DataSource = rdr;
            GridView1.DataBind();
        }
    }
}

protected void GetDataType2()
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        string query =
            "select t1.id as [City Id], t2.name as Country, t1.name as City from cities as t1 " +
            "join countries as t2 on t2.id = t1.country_id";

        SqlDataAdapter da = new SqlDataAdapter(query, con);
        DataSet ds = new DataSet();
        da.Fill(ds);
        GridView1.DataSource = ds;
        GridView1.DataBind();
    }
}




protected void GetDataType3()
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        string query =
            "select t1.id as [City Id], t2.name as Country, t1.name as City from cities as t1 " +
            "join countries as t2 on t2.id = t1.country_id where t1.name like @textSearch";

        SqlCommand cmd = new SqlCommand(query, con);
        //cmd.CommandType = System.Data.CommandType.StoredProcedure;
        cmd.Parameters.AddWithValue("@textSearch", "%" + txtSearch.Text + "%");
        con.Open();
        using (SqlDataReader rdr = cmd.ExecuteReader())
        {
            GridView1.DataSource = rdr;
            GridView1.DataBind();
        }
        
        
    }
}



protected void GetDataType4()
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        string query =
            "select t1.id as [City Id], t2.name as Country, t1.name as City from cities as t1 " +
            "join countries as t2 on t2.id = t1.country_id where t1.name like @textSearch";

        SqlDataAdapter da = new SqlDataAdapter(query, con);
        //da.SelectCommand.CommandType = CommandType.StoredProcedure;
        da.SelectCommand.Parameters.AddWithValue("@textSearch", "%" + txtSearch.Text + "%");

        DataSet ds = new DataSet();
        da.Fill(ds);
        GridView1.DataSource = ds;
        GridView1.DataBind();
    }
}



protected void GetDataType5()
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        DataSet ds = new DataSet();
        string query = @"select t1.id as id, CONVERT(varchar(10),t1.dob,121) AS dob, 
        t4.id as country_id, t1.city_id as city_id, t3.id as state_id, 
        t1.name as Student,t1.email as Email,t4.name as Country,t3.name as State,
        t2.name as City, convert(varchar(11),t1.created_at,106) as Date,
        (case when t1.status = 0 then 'Inactive' else 'Active' end) as Status 
        from Students as t1 
        join Cities as t2 on t2.id = t1.city_id 
        join States as t3 on t3.id = t2.state_id 
        join Countries as t4 on t4.id = t2.country_id where t1.id = @id";
        SqlDataAdapter da = new SqlDataAdapter(query, con);

        da.SelectCommand.Parameters.AddWithValue("@id", + id );
        da.Fill(ds);
        int id = CONVERT
        string student = ds.Tables[0].Rows[0]["Student"].ToString();
        string email = ds.Tables[0].Rows[0]["Email"].ToString();
        string country_id = ds.Tables[0].Rows[0]["country_id"].ToString();
        string city_id = ds.Tables[0].Rows[0]["city_id"].ToString();
        string state_id = ds.Tables[0].Rows[0]["state_id"].ToString();

    }
}




protected void GetddlCountry()
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        string query = "select t1.id, t1.name as Country from Countries as t1";

        SqlDataAdapter da = new SqlDataAdapter(query, con);
        DataSet ds = new DataSet();
        da.Fill(ds);

        
        ddlCountry.DataTextField = "Country";
        ddlCountry.DataValueField = "id";
        ddlCountry.DataSource = ds;// get the data into the list you can set it
        ddlCountry.DataBind();
        ddlCountry.Items.Insert(0, new ListItem("Select Item",""));


    }
}

protected void ddlCountry_SelectedIndexChanged(object sender, EventArgs e)
{
    //Response.Write(" list value : " + ddlCountry.SelectedItem.Value + " = "+ ddlCountry.SelectedItem.Text + " = " + ddlCountry.SelectedValue);
    if (ddlCountry.SelectedItem.Value == "")
    {
        ddlState.Items.Clear();
    }
    else {
        ddlState.Items.Clear();
        int country_id = Convert.ToInt32(ddlCountry.SelectedItem.Value);
        GetddlState(country_id);
        
    }
    
}



protected void GetddlState(int country_id)
{
    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        string query = "select t1.id, t1.name as State from States as t1 where t1.country_id = @country_id";

        SqlDataAdapter da = new SqlDataAdapter(query, con);
        da.SelectCommand.Parameters.AddWithValue("@country_id", country_id);
        DataSet ds = new DataSet();
        da.Fill(ds);
        if (ddlCountry.SelectedItem.Value != null)
        {

            ddlState.DataTextField = "State";
            ddlState.DataValueField = "id";
            ddlState.DataSource = ds;// get the data into the list you can set it
            ddlState.DataBind();
            ddlState.Items.Insert(0, new ListItem("Select Item", ""));
        }
    }
}









protected void btnSubmit_Click(object sender, EventArgs e)
{
    //Response.Write("Your Name " + txtName.Text + " <br />" + "Your Email " + txtEmail.Text);

    string name = txtName.Text;
    string email = txtEmail.Text;
    int country_id = Convert.ToInt32(ddlCountry.SelectedItem.Value);
    int state_id = Convert.ToInt32(ddlState.SelectedItem.Value);
    int city_id = Convert.ToInt32(ddlCity.SelectedItem.Value);

    using (SqlConnection con = new SqlConnection(CS))
    {
        //string delquery = "delete from usermenus where user_id = @user_id";
        //string upquery = @"update users set updated_at = GETDATE() where id = @id";

        string query ="insert into Students (name,email,city_id) values (@name,@email,@city_id)";

        SqlCommand cmd = new SqlCommand(query, con);
        //cmd.CommandType = System.Data.CommandType.StoredProcedure;
        cmd.Parameters.AddWithValue("@name", name);
        cmd.Parameters.AddWithValue("@email", email);
        cmd.Parameters.AddWithValue("@city_id", city_id);
        con.Open();
        int count = cmd.ExecuteNonQuery();
        if (count > 0)
        {
            Response.Write("Data Inserted Successfully");
        }
        else
        {
            Response.Write("Data Did Not Inserted Successfully");
        }
        con.Close();


    }



}



protected void Button2_Click(object sender, EventArgs e)
{
    string _userName = TextBox199.Text.ToString();
    string _password = TextBox2.Text.ToString();

    using (SqlConnection con = new SqlConnection(CS))
    {
        con.Open();
        string query = @"select * from Users where Username = @userName AND PasswordHash = HashBytes('SHA2_256', @password)";

        SqlDataAdapter da = new SqlDataAdapter(query, con);
        da.SelectCommand.Parameters.AddWithValue("@userName", _userName);
        da.SelectCommand.Parameters.AddWithValue("@password",_password).SqlDbType = SqlDbType.VarChar;

        DataSet ds = new DataSet();
        da.Fill(ds);

        int count = ds.Tables[0].Rows.Count;
        if (count > 0)
        {
            string userName = ds.Tables[0].Rows[0]["Name"].ToString();

            Response.Write("User Name Is : " + userName);

        }
        
        //return;
        
        
    }



}

// Treeview - 1

private void GetMenuItems(){
    //string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
    SqlConnection con = new SqlConnection(CS);
    string query = @"select * from tblMenuItemsLevel1;select * from tblMenuItemsLevel2";
    SqlDataAdapter da = new SqlDataAdapter(query, con);
    //da.SelectCommand.CommandType = CommandType.StoredProcedure;
    DataSet ds = new DataSet();
    da.Fill(ds);

    ds.Relations.Add("ChildRows", ds.Tables[0].Columns["ID"], ds.Tables[1].Columns["ParentId"]);

    foreach (DataRow level1DataRow in ds.Tables[0].Rows)
    {
        MenuItem item = new MenuItem();
        item.Text = level1DataRow["MenuText"].ToString();
        item.NavigateUrl = level1DataRow["NavigateURL"].ToString();
        item.ImageUrl = level1DataRow["ImageURL"].ToString();

        DataRow[] level2DataRows = level1DataRow.GetChildRows("ChildRows");
        foreach (DataRow level2DataRow in level2DataRows)
        {
            MenuItem childItem = new MenuItem();
            childItem.Text = level2DataRow["MenuText"].ToString();
            childItem.NavigateUrl = level2DataRow["NavigateURL"].ToString();
            childItem.ImageUrl = level2DataRow["ImageURL"].ToString();
            item.ChildItems.Add(childItem);
        }
        Menu2.Items.Add(item);
    }
}



// Treeview - 2

private void GetTreeViewItems()
{
    string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
    SqlConnection con = new SqlConnection(cs);
    
    string query = @"select ID, ParentId, name from tree_table";

    SqlDataAdapter da = new SqlDataAdapter(query, con);
    DataSet ds = new DataSet();
    da.Fill(ds);

    ds.Relations.Add("ChildRows", ds.Tables[0].Columns["ID"], 
        ds.Tables[0].Columns["ParentId"]);

    foreach (DataRow level1DataRow in ds.Tables[0].Rows)
    {
        if (string.IsNullOrEmpty(level1DataRow["ParentId"].ToString()))
        {
            TreeNode parentTreeNode = new TreeNode();
            parentTreeNode.Text = level1DataRow["TreeViewText"].ToString();
            parentTreeNode.NavigateUrl = level1DataRow["NavigateURL"].ToString();

            DataRow[] level2DataRows = level1DataRow.GetChildRows("ChildRows");
            foreach (DataRow level2DataRow in level2DataRows)
            {
                TreeNode childTreeNode = new TreeNode();
                childTreeNode.Text = level2DataRow["TreeViewText"].ToString();
                childTreeNode.NavigateUrl = level2DataRow["NavigateURL"].ToString();
                parentTreeNode.ChildNodes.Add(childTreeNode);
            }
            Treeview1.Nodes.Add(parentTreeNode);
        }
    }
}



// Treeview - 3

private void GetTreeViewItems()
{
    string cs = ConfigurationManager.ConnectionStrings["DBCS"].ConnectionString;
    SqlConnection con = new SqlConnection(cs);
    
    string query = @"select ID, ParentId, name from tree_table";

    SqlDataAdapter da = new SqlDataAdapter(query, con);
    DataSet ds = new DataSet();
    da.Fill(ds);

    ds.Relations.Add("ChildRows", ds.Tables[0].Columns["ID"], 
        ds.Tables[0].Columns["ParentId"]);

    foreach (DataRow level1DataRow in ds.Tables[0].Rows)
    {
        if (string.IsNullOrEmpty(level1DataRow["ParentId"].ToString()))
        {
            TreeNode parentTreeNode = new TreeNode();
            parentTreeNode.Text = level1DataRow["TreeViewText"].ToString();
            parentTreeNode.NavigateUrl = level1DataRow["NavigateURL"].ToString();
            GetChildRows(level1DataRow, parentTreeNode);
            Treeview1.Nodes.Add(parentTreeNode);
        }
    }
}

private void GetChildRows(DataRow dataRow, TreeNode treeNode)
{
    DataRow[] childRows = dataRow.GetChildRows("ChildRows");
    foreach (DataRow row in childRows)
    {
        TreeNode childTreeNode = new TreeNode();
        childTreeNode.Text = row["TreeViewText"].ToString();
        childTreeNode.NavigateUrl = row["NavigateURL"].ToString();
        treeNode.ChildNodes.Add(childTreeNode);

        if (row.GetChildRows("ChildRows").Length > 0)
        {
            GetChildRows(row, childTreeNode);
        }
    }
}





string query = @"SELECT TOP 1 id, CONVERT(varchar(17),created_at,113) AS created_at 
                    From (SELECT TOP 2 * FROM userlogs ORDER BY id DESC) as t1 ORDER BY id";

string query = @"select id, CONCAT(name, ' ( ', username, ' )') as name from users where id != 1";

string query = @"select row_number() over (order by t1.id) as row_number, t1.id, t1.name as name,
                    convert(varchar(11),t1.created_at,106) as created_at,t1.email as email,t1.username as username,
                    (case when t1.status = 0 then 'Inactive' else 'Active' end) as status 
                    from users as t1 where id != 1";

string query = @"select t1.id as id,t1.name as Student,t1.email as Email,t4.name as Country,
                t3.name as State, t2.name as City, convert(varchar(11),t1.created_at,106) as Date, 
                (case when t1.status = 0 then 'Inactive' else 'Active' end) as Status
                from Students as t1 join Cities as t2 on t2.id = t1.city_id 
                join States as t3 on t3.id = t2.state_id 
                join Countries as t4 on t4.id = t2.country_id";



string query = @"select top 50 row_number() over (order by t1.id) as row_number, t1.id, t1.name as name,
                    convert(varchar(11),t1.created_at,106) as created_at,t1.email as email,t1.username as username, 
                    t1.address as address, t2.name as branch,
                    (case when t1.status = 0 then 'Inactive' else 'Active' end) as status 
                    from users as t1 
                    join branches as t2 on t2.id = t1.branch_id
                    where t1.id <> 1 AND t1.ulevel = 10000 order by t1.id desc"

string query = @"select top 50 row_number() over (order by t1.id) as row_number, t1.id, t1.name as name,
                    convert(varchar(11),t1.created_at,106) as created_at,t1.email as email,t1.username as username, 
                    t1.address as address, t2.name as branch,
                    (case when t1.status = 0 then 'Inactive' else 'Active' end) as status 
                    from users as t1 
                    join branches as t2 on t2.id = t1.branch_id
                    where t1.id <> 1 AND t1.ulevel = 10000 order by t1.id desc"


string query = @"select top 1 t2.name as branch, t3.name as vendor, t4.name as whocreter, 
                  t1.code as code, t1.vat as vat, t1.subtotal as subtotal,
                  t1.total as total,t1.grandtotal as grandtotal, 
                  t1.status as status,t1.isreq as isreq,
                  convert(varchar(11),t1.created_at,106) as created_at,
                  convert(varchar(19),t1.vchdate,0) as vchdate
                  
                  from purchases as t1
                  join branches as t2 on t1.branch_id = t2.id
                  join vendors as t3 on t1.vendor_id = t3.id
                  join users as t4 on t1.user_id = t4.id
                  where t1.id = 18 AND t1.branch_id = 3"



string query = @"select top 50 row_number() over (order by t1.id) as rownumber, 
              t1.id as id, t1.vat as vat, t1.subtotal as subtotal, 
              t1.total as total,t1.grandtotal as grandtotal, t1.lcno as lcno,
              t1.remarks as remarks, t1.code as code,
              (case when t1.status = 0 then 'Inactive' else 'Active' end) as status,
              (case when t1.isreq = 0 then 'Inactive' else 'Active' end) as isreq,
              convert(varchar(11),t1.created_at,106) as created_at,
              convert(varchar(11),t1.updated_at,106) as updated_at,
              t1.requisition as requisition,  
              t2.name as branch, t3.name as vendor,t4.name as username
              from purchases as t1
              left join branches as t2 on t2.id = t1.branch_id
              left join vendors as t3 on t3.id = t1.vendor_id
              left join users as t4 on t4.id = t1.user_id
              where t1.branch_id = 3";


                    WIN-KUPH617JEUN\SQLEXPRESS




        string url = ~UserAdd ; 

        String str = "~UserAdd"; 
        
        string substr = str.substring(1,5);

        String[] spearator = { "~" }; 
        Int32 count = 1; 
  
        // using the method 
        String[] strlist = str.Split(spearator, count, 
               StringSplitOptions.RemoveEmptyEntries); 

        


        fdate.Value = DateTime.Today.AddMonths(-1).ToString("yyyy-MM-dd");
        todate.Value = DateTime.Now.ToString("yyyy-MM-dd");


        //"en-US", "en-GB", "fr-FR","de-DE", "ru-RU"

        string localDate = DateTime.Now.ToString("yyyy-MM-dd HH:mm:ss");
        //var culture = new CultureInfo("en-GB");
        //Response.Write("Local DateTime  : " + localDate + " CultureInfo : " + localDate.ToString(culture));
        //return;

        @created_at,@updated_at
        cmd.Parameters.AddWithValue("@created_at", localDate);
        cmd.Parameters.AddWithValue("@updated_at", localDate);


        Label15.Text = subtotal.ToString("0.00");
        Label16.Text = vat.ToString("0.00");
        Label17.Text = grandtotal.ToString("0.00");

        Label17.Text = grandtotal.ToString("C2",new CultureInfo("bn-BD"));
        Label17.Text = grandtotal.ToString("N2",new CultureInfo("bn-BD"));
        Label17.Text = grandtotal.ToString(this._crcd, new CultureInfo(this._cr));



        Label17.Text = grandtotal.ToString("C2",new CultureInfo("bn-BD"));
        Label17.Text = grandtotal.ToString("N2",new CultureInfo("bn-BD"));


        Text='<%# Bind("quantity", "{0:N0}") %>'

        DataFormatString="{0:C}"
        DataFormatString="{0:N2}"


        CultureInfo us = new CultureInfo("bn-BD");
        double number = 102350.25;
        string number0 =  String.Format("{0:#,###,###.##}", number);
        string number1 =  number.ToString("C0", us);
        string number2 =  number.ToString("N2", us);


        Response.Write(" number2 : " + number2 + " number1 : " + number1+ " number0 : " + number0);




        GridView1.UseAccessibleHeader = true;
        GridView1.HeaderRow.TableSection =
        TableRowSection.TableHeader;

        OnRowDataBound="GridView1_RowDataBound" Width="100%"

        protected void GridView1_RowDataBound(object sender, GridViewRowEventArgs e)
        {
            if (e.Row.RowType == DataControlRowType.Header)
            {
                //add the thead and tbody section programatically
                e.Row.TableSection = TableRowSection.TableHeader;
            }
        }



  //Page.ClientScript.RegisterStartupScript(this.GetType(), "CallFunction", "CallFunction()", true);
  //ScriptManager.RegisterStartupScript(this, GetType(), "CallFunction", "CallFunction();", true);

  //string jquery1 = @"$(document).ready(function () {console.log('hello im console log'); alert('hello im console log');})";

  //            string jquery = @"
  //<script src='Assets / scripts / jquery.dataTables.min.js'></script>
  //        < script src = 'Assets/scripts/dataTables.bootstrap.min.js' ></ script >
  //     < script type ='text/javascript'> $(document).ready(function () { 
  //                    alert('hello im console log');
  //                    $('#<%= GridView1.ClientID %>').DataTable({
  //                        scrollY: '300',
  //                        scrollX: true,
  //                    });
  //                }) </script>";

  //            ClientScript.RegisterStartupScript(typeof(Page), "a key",
  //              jquery 
  //             );


<input type="button" class="form-control" onclick="PrintDiv()" value="Print" />
<div class="widget-content">

<script type="text/javascript">
    function PrintDiv() {
        var divToPrint = document.getElementsByClassName('widget-content')[0];
        var popupWin = window.open('invoice', '_blank', 'width=800,height=auto,location=no,left=200px');
        popupWin.document.open();
        popupWin.document.write('<html><head><link href="Assets/css/style.css" rel="stylesheet" type="text/css"><link href="Assets/css/bootstrap.min.css" rel="stylesheet" type="text/css"></head><body onload="window.print()">' + divToPrint.innerHTML + '</body></html>');
        popupWin.document.close();
    }
</script>
</div>



GridView1.DataSource = PurchaseDetailDataAccessLayer.GetAllPurchaseDetail();
GridView1.DataBind();
PurchaseDetailDataAccessLayer PurchaseDetailDataAccessLayer = new PurchaseDetailDataAccessLayer();
List<PurchaseDetail> PurchaseDetails = PurchaseDetailDataAccessLayer.GetAllPurchaseDetail();
Response.Write("Value is : " + PurchaseDetails.Count + "<br/>");
foreach (var item in PurchaseDetails)
{
    Response.Write("Value is : " + item.code + "<br/>");
}




vchdate.Value = DateTime.Now.ToString("yyyy-MM-dd");


<div class="form-group">
    <div class="col-md-3">
        <label for="Level" class="control-label">Voucher Date</label>
        <div class="input-group date">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
            <input name="vchdate" runat="server" placeholder="YYYY-MM-DD" value="" type="text" class="form-control datepicker3" id="vchdate" autocomplete="off">
        </div>
    </div>
</div>


fdate.Value = DateTime.Today.AddMonths(-1).ToString("yyyy-MM-dd");
todate.Value = DateTime.Now.ToString("yyyy-MM-dd");

<div class="form-group">
    <div class="col-md-6">
        <label for="Level" class="control-label">From Date</label>
        <div class="input-group date">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
            <input name="fdate" runat="server" placeholder="YYYY-MM-DD" value="" type="text" class="form-control datepicker3" id="fdate" autocomplete="off">
        </div>
    </div>
</div>

<div class="form-group">
    <div class="col-md-6">
        <label for="Level" class="control-label">From Date</label>
        <div class="input-group date">
            <div class="input-group-addon">
            <i class="fa fa-calendar"></i>
            </div>
            <input name="todate" runat="server" placeholder="YYYY-MM-DD" value="" type="text" class="form-control datepicker3" id="todate" autocomplete="off">
        </div>
    </div>
</div>




GridView1.DataSource = PurchaseDetailDataAccessLayer.GetAllPurchaseDetail();
GridView1.DataBind();
PurchaseDetailDataAccessLayer PurchaseDetailDataAccessLayer = new PurchaseDetailDataAccessLayer();

List<PurchaseDetail> PurchaseDetails = PurchaseDetailDataAccessLayer.GetAllPurchaseDetail();

Response.Write("Value is : " + PurchaseDetails.Count + "<br/>");

foreach (var item in PurchaseDetails)
{
   Response.Write("Value is : " + item.code + "<br/>");
}

GridView1.DataSource =  PurchaseDataAccessLayer.GetAllPurchase();
GridView1.DataBind();



string time = DateTime.Now.ToString("hh:mm:ss"); // includes leading zeros
string date = DateTime.Now.ToString("yyyy-MM-dd"); // includes leading zeros

Response.Write("Now Date Tieme : " + time + " Now Date Tieme : " + date);

//From Page Code

string PVID = ((LinkButton)sender).CommandArgument;
Response.Redirect("PurchaseInvoice.aspx?PVID=" + PVID);

HttpCookie cookie = new HttpCookie("Democookie");
cookie["PVID"] = PVID;
Response.Cookies.Add(cookie);
Response.Redirect("PurchaseInvoice.aspx");

//TO Page Code
string PVID = Request.QueryString["PVID"];
Response.Write("purchaseID : " + PVID);

HttpCookie cookie = Request.Cookies["Democookie"];
string PVID = null;
if (cookie != null)
{
    PVID = cookie["PVID"];
}

Response.Write("purchaseID : " + PVID);
Response.Write("<script>" + "window.open('PurchaseInvoice.aspx','_blank')" + "</script>");

//To Remoove Cookie
HttpCookie cookie = Request.Cookies["Democookie"];
cookie.Expires = DateTime.Now.AddDays(-1);
Response.Cookies.Add(cookie);
Response.Write("<script>" + "window.close()" + "</script>");


private void GetSelectedTreeNodes10(TreeNode ParentNodeItem, int user_id)
        {

            //string inquery = "insert into usermenus (user_id,parent,child,nurl,status) values (@user_id,@parent,@child,@nurl,1)";

            //SqlCommand cmd = BaseClass.CommandBuilder(inquery);
            ////cmd.CommandType = System.Data.CommandType.StoredProcedure;
            //cmd.Parameters.AddWithValue("@user_id", user_id);
            //cmd.Parameters.AddWithValue("@parent", ParentNodeItem.Text);
            //cmd.Parameters.AddWithValue("@child", ParentNodeItem.Text);
            //cmd.Parameters.AddWithValue("@nurl", ParentNodeItem.NavigateUrl);
            //cmd.ExecuteNonQuery();


            //string message1 = user_id + " == " + ParentNodeItem.Text + " == " + ParentNodeItem.NavigateUrl + "<br>";
            //Response.Write(" ShowCheckBox0 : " + ParentNodeItem.ShowCheckBox + " == " + ParentNodeItem.Checked + "<br/>");

            //Response.Write(" ChildNode Item0 : " + message1);

            foreach (TreeNode ChildNodeItem in ParentNodeItem.ChildNodes)
            {
                if (ChildNodeItem.ChildNodes.Count > 0)
                {
                    GetSelectedTreeNodes11(ChildNodeItem, user_id);
                }
                else
                {

                    if (ChildNodeItem.Checked)
                    {
                        //string message = user_id + "  ==  " + ChildNodeItem.Parent.Text + " == " + ChildNodeItem.Text + " == " + ChildNodeItem.NavigateUrl + "<br>";
                        //Response.Write(" ShowCheckBox1 : " + ChildNodeItem.ShowCheckBox + " == " + ChildNodeItem.Checked + "<br/>");
                        //Response.Write(" ChildNode Item1 : " + message + "<br/>");

                        string inquery1 = "insert into usermenus (user_id,parent,child,nurl,status) values (@user_id,@parent,@child,@nurl,0)";

                        SqlCommand cmd1 = BaseClass.CommandBuilder(inquery1);
                        //cmd.CommandType = System.Data.CommandType.StoredProcedure;
                        cmd1.Parameters.AddWithValue("@user_id", user_id);
                        cmd1.Parameters.AddWithValue("@parent", ChildNodeItem.Parent.Text);
                        cmd1.Parameters.AddWithValue("@child", ChildNodeItem.Text);
                        cmd1.Parameters.AddWithValue("@nurl", ChildNodeItem.NavigateUrl);
                        cmd1.ExecuteNonQuery();

                        //===========================

                        //=========
                        string ch_query = @"select id from usermenus where user_id = '" + user_id + "' AND parent = '"+ ChildNodeItem.Parent.Text + "' AND status = 1";
                        SqlDataReader rdr = BaseClass.ExecuteDataRdr(ch_query);

                        DataTable dt = new DataTable();
                        dt.Load(rdr);
                        int rowCount = dt.Rows.Count;
                        BaseClass.Con.Close();

                        if (rowCount > 0)
                        {
                            string dl_query = @"delete from usermenus where user_id = '" + user_id + "' AND parent = '" + ChildNodeItem.Parent.Text + "' AND status = 1";
                            SqlCommand cmd3 = BaseClass.CommandBuilder(dl_query);
                            int rowCount1 = cmd3.ExecuteNonQuery();
                        }

                        //=========

                        string inquery2 = "insert into usermenus (user_id,parent,child,nurl,status) values (@user_id,@parent,@child,@nurl,1)";

                        SqlCommand cmd2 = BaseClass.CommandBuilder(inquery2);
                        //cmd.CommandType = System.Data.CommandType.StoredProcedure;
                        cmd2.Parameters.AddWithValue("@user_id", user_id);
                        cmd2.Parameters.AddWithValue("@parent", ChildNodeItem.Parent.Text);
                        cmd2.Parameters.AddWithValue("@child", ChildNodeItem.Parent.Text);
                        cmd2.Parameters.AddWithValue("@nurl", ChildNodeItem.Parent.NavigateUrl);
                        cmd2.ExecuteNonQuery();

                    }


                }
            }

        }


        private void GetSelectedTreeNodes11(TreeNode ParentNodeItem, int user_id)
        {
            //string message1 = user_id + "  ==  " + ParentNodeItem.Parent.Text + " == " + ParentNodeItem.NavigateUrl + "<br>";
            //Response.Write(" ShowCheckBox01 : " + ParentNodeItem.ShowCheckBox + " == " + ParentNodeItem.Checked + "<br/>");
            //Response.Write(" ChildNode Item01 : " + message1);


            


            

            foreach (TreeNode ChildNodeItem in ParentNodeItem.ChildNodes)
            {
                if (ChildNodeItem.ChildNodes.Count > 0)
                {
                    GetSelectedTreeNodes11(ChildNodeItem, user_id);
                }
                else
                {
                    

                    if (ChildNodeItem.Checked)
                    {
                        //string message = user_id + "  ==  " + ChildNodeItem.Parent.Text + " == " + ChildNodeItem.Text + " == " + ChildNodeItem.NavigateUrl + "<br>";
                        //Response.Write(" ShowCheckBox2 : " + ChildNodeItem.ShowCheckBox + " == " + ChildNodeItem.Checked + "<br/>");
                        //Response.Write(" ChildNode Item2 : " + message);

                        string inquery1 = "insert into usermenus (user_id,parent,child,nurl,status) values (@user_id,@parent,@child,@nurl,0)";

                        SqlCommand cmd1 = BaseClass.CommandBuilder(inquery1);
                        //cmd.CommandType = System.Data.CommandType.StoredProcedure;
                        cmd1.Parameters.AddWithValue("@user_id", user_id);
                        cmd1.Parameters.AddWithValue("@parent", ChildNodeItem.Parent.Text);
                        cmd1.Parameters.AddWithValue("@child", ChildNodeItem.Text);
                        cmd1.Parameters.AddWithValue("@nurl", ChildNodeItem.NavigateUrl);
                        cmd1.ExecuteNonQuery();


                        //=========
                        string ch_query = @"select id from usermenus where user_id = '" + user_id + "' AND parent = '" + ParentNodeItem.Parent.Text + "' AND status = 1";
                        SqlDataReader rdr = BaseClass.ExecuteDataRdr(ch_query);

                        DataTable dt = new DataTable();
                        dt.Load(rdr);
                        int rowCount = dt.Rows.Count;
                        BaseClass.Con.Close();

                        if (rowCount > 0)
                        {
                            string dl_query = @"delete from usermenus where user_id = '" + user_id + "' AND parent = '" + ParentNodeItem.Parent.Text + "' AND status = 1";
                            SqlCommand cmd3 = BaseClass.CommandBuilder(dl_query);
                            int rowCount1 = cmd3.ExecuteNonQuery();
                        }

                        //=========


                        string inquery = "insert into usermenus (user_id,parent,child,nurl,status) values (@user_id,@parent,@child,@nurl,1)";

                        SqlCommand cmd = BaseClass.CommandBuilder(inquery);
                        //cmd.CommandType = System.Data.CommandType.StoredProcedure;
                        cmd.Parameters.AddWithValue("@user_id", user_id);
                        cmd.Parameters.AddWithValue("@parent", ParentNodeItem.Parent.Text);
                        cmd.Parameters.AddWithValue("@child", ParentNodeItem.Parent.Text);
                        cmd.Parameters.AddWithValue("@nurl", ParentNodeItem.NavigateUrl);
                        cmd.ExecuteNonQuery();
                    }

                }
            }

        }