<div>
    404,464,713

    DL CN21940 26969

    <asp:SqlDataSource runat="server" ID="SqlDataSource1" ConnectionString='<%$ ConnectionStrings:CSDB %>' SelectCommand="SELECT [id], [name] FROM [Countries]"></asp:SqlDataSource>
    
    <asp:SqlDataSource ID="SqlDataSource2" runat="server" ConnectionString="<%$ ConnectionStrings:CSDB %>" SelectCommand="SELECT [id], [name], [country_id] FROM [States] WHERE ([country_id] = @country_id)">
       
        <SelectParameters>
            <asp:ControlParameter ControlID="DropDownList1" Name="country_id" PropertyName="SelectedValue" Type="Int32" />
        </SelectParameters>
    </asp:SqlDataSource>

    <asp:SqlDataSource ID="SqlDataSource3" runat="server" ConnectionString="<%$ ConnectionStrings:CSDB %>" SelectCommand="SELECT [id], [state_id], [name] FROM [Cities] WHERE ([state_id] = @state_id)">
        <SelectParameters>
            <asp:ControlParameter ControlID="DropDownList2" DefaultValue="" Name="state_id" PropertyName="SelectedValue" Type="Int32" />
        </SelectParameters>
    </asp:SqlDataSource>

</div>

<div>
    
    <asp:DropDownList ID="DropDownList1" runat="server" DataSourceID="SqlDataSource1" DataTextField="name" DataValueField="id" AppendDataBoundItems="true" AutoPostBack="true" OnSelectedIndexChanged="DropDownList1_SelectedIndexChanged" Width="50%" Height="30px"></asp:DropDownList>

    <asp:DropDownList ID="DropDownList2" runat="server" AppendDataBoundItems="true" 
    AutoPostBack="true" DataSourceID="SqlDataSource2" DataTextField="name" 
    DataValueField="id" OnSelectedIndexChanged="DropDownList2_SelectedIndexChanged" 
    Width="50%" Height="30px"></asp:DropDownList>

    <asp:DropDownList ID="DropDownList3" runat="server" AppendDataBoundItems="true" AutoPostBack="false" DataSourceID="SqlDataSource3" DataTextField="name" DataValueField="id" Width="50%" Height="30px"></asp:DropDownList>

</div>



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


public void GetCountryDropDownListData()
{
    
    string query = @"select * from countries";
    SqlDataReader rdr = BaseClass.ExecuteDataRdr(query);

    //DataTable dt = new DataTable();
    //dt.Load(rdr);

    DropDownList1.DataTextField = "name";
    DropDownList1.DataValueField = "id";
    DropDownList1.DataSource = rdr;// get the data into the list you can set it
    DropDownList1.DataBind();
    DropDownList1.Items.Insert(0, new ListItem("Select Item",""));
    BaseClass.Con.Close();

}