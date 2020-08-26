<%@ Page Language="C#" AutoEventWireup="true" CodeBehind="WebForm3.aspx.cs" Inherits="WebApplication1.WebForm3" %>

<!DOCTYPE html>

<html xmlns="http://www.w3.org/1999/xhtml">
<head runat="server">
    <title></title>
    <link rel="stylesheet" href="https://cdnjs.cloudflare.com/ajax/libs/font-awesome/4.7.0/css/font-awesome.min.css">
</head>
<body>
    <form id="form1" runat="server">
        <div>
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
            <br />
            <asp:Label ID="Label1" runat="server" Text="Country : "></asp:Label>
            <br />
            <asp:DropDownList ID="DropDownList1" runat="server" DataSourceID="SqlDataSource1" DataTextField="name" DataValueField="id" AppendDataBoundItems="true" AutoPostBack="true" OnSelectedIndexChanged="DropDownList1_SelectedIndexChanged" Width="50%" Height="30px" required="required"></asp:DropDownList>
            <br /><br />

            <asp:Label ID="Label2" runat="server" Text="State : "></asp:Label>
            <br />
            <asp:DropDownList ID="DropDownList2" runat="server" AppendDataBoundItems="true" AutoPostBack="true" DataSourceID="SqlDataSource2" DataTextField="name" DataValueField="id" OnSelectedIndexChanged="DropDownList2_SelectedIndexChanged" Width="50%" Height="30px" required="required"></asp:DropDownList>

            <br /><br />
            <asp:Label ID="Label3" runat="server" Text="City : "></asp:Label>
            <br />
            <asp:DropDownList ID="DropDownList3" runat="server" AppendDataBoundItems="true" AutoPostBack="false" DataSourceID="SqlDataSource3" DataTextField="name" DataValueField="id" Width="50%" Height="30px" required="required"></asp:DropDownList>
            
            <br /><br />
            <asp:Label ID="Label4" runat="server" Text="Full Name : "></asp:Label>
            <br />
            <asp:TextBox ID="TextBox1" runat="server" Height="27px" Width="50%" AutoCompleteType="Disabled" required="required"></asp:TextBox>
           
            <br /><br />
            <asp:Label ID="Label5" runat="server" Text="Email : "></asp:Label>
            <br />
            <asp:TextBox ID="TextBox2" runat="server" Height="27px" Width="50%" AutoCompleteType="Disabled" TextMode="Email" required="required"></asp:TextBox>
            <br /><br />
            
            <asp:Label ID="Label6" runat="server" Text="Date Of Birth : "></asp:Label>
            <br />
            <asp:TextBox ID="TextBox3" runat="server" Height="27px" Width="50%" AutoCompleteType="Disabled" TextMode="Date" required="required"></asp:TextBox>
            <br /><br />

            <asp:Button ID="Button1" runat="server" Text="Process ..." BackColor="#339966" BorderColor="#339966" ForeColor="White" Height="30px" Width="50%" Style="cursor:pointer" OnClick="Button1_Click"/>
            <br /><br />
        </div>
        
        
        <div>
            <asp:GridView ID="GridView1" runat="server" BackColor="#DEBA84" BorderColor="#DEBA84" BorderStyle="None" BorderWidth="1px" CellPadding="3" CellSpacing="2" Width="100%">
                <FooterStyle BackColor="#F7DFB5" ForeColor="#8C4510" />
                <HeaderStyle BackColor="#A55129" Font-Bold="True" ForeColor="White" />
                <PagerStyle ForeColor="#8C4510" HorizontalAlign="Center" />
                <RowStyle BackColor="#FFF7E7" ForeColor="#8C4510" />
                <SelectedRowStyle BackColor="#738A9C" Font-Bold="True" ForeColor="White" />
                <SortedAscendingCellStyle BackColor="#FFF1D4" />
                <SortedAscendingHeaderStyle BackColor="#B95C30" />
                <SortedDescendingCellStyle BackColor="#F1E5CE" />
                <SortedDescendingHeaderStyle BackColor="#93451F" />
                <Columns>

                <asp:TemplateField HeaderText="Action">
                            <ItemTemplate>
                                
                                <asp:LinkButton ID="BtnEdit" CommandArgument='<%# Eval("id") %>' runat="server" OnClick="BtnEdit_Click">
<span class="btn btn-xs btn-warning"><i class="fa fa-pencil-square-o" aria-hidden="true"></i></span>
                                </asp:LinkButton>

                                <asp:LinkButton ID="BtnDelete" CommandArgument='<%# Eval("id") %>' runat="server" OnClientClick="if ( ! UserDeleteConfirmation()) return false;">
<span class="btn btn-xs btn-danger"><i class="fa fa-trash-o" aria-hidden="true"></i></span>
                                </asp:LinkButton>


                            </ItemTemplate>
                        </asp:TemplateField>
</Columns>
            </asp:GridView>
        </div>
    </form>


    <script type="text/javascript">
        function UserDeleteConfirmation() {
            return confirm("Are you sure you want to delete this user?");
        }

        <%--function UserStatusConfirmation() {
            return confirm("Are you sure you want to change status of this user?");
        }

        $(document).ready(function () {
            $('#<%=GridView1.ClientID %>').Scrollable({
                ScrollHeight: 200,
                IsInUpdatePanel: false
            });
        })--%>
    </script>
</body>
</html>
