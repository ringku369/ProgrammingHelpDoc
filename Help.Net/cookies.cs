
// Details Link
  https://www.c-sharpcorner.com/uploadfile/annathurai/cookies-in-Asp-Net/


// Set Cookies
    HttpCookie cookie = new HttpCookie("userInfo");
    cookie["PVID"] = PVID;
    cookie["BranchID"] = this._branch_id.ToString();
    Response.Cookies.Add(cookie);
    Response.Redirect("PurchaseInvoice.aspx");
// Set Cookies

// Get Cookies
    string BranchID = Request.QueryString["BranchID"];
    var PVID = Request.Cookies["PVID"].Value;

    HttpCookie reqCookies = Request.Cookies["userInfo"];  
    if (reqCookies != null)  
    {  
        string BranchID = reqCookies["BranchID"].ToString();  
        string PVID = reqCookies["PVID"].ToString();
    } 

// Get Cookies

// Remove  Cookies
    if (Request.Cookies["userInfo"] != null)
    {
      Response.Cookies["userInfo"].Expires = DateTime.Now.AddDays(-1);   
    }
// Remove  Cookies





    HttpCookie cookie = new HttpCookie("UserInfo");
    cookie["UserID"] = this._user_id;
    cookie["LastLogin"] = ds1.Tables[0].Rows[0]["created_at"].ToString();
    Response.Cookies.Add(cookie);