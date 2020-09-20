<?php  

double dramount = 0;
double cramount = 0;
protected void GridView1_RowDataBound(object sender, GridViewRowEventArgs e)
{
  
  //GridView1.FooterRow.Cells[6].Text = " Grand Total ";
  //GridView1.FooterRow.Cells[7].Text = "100";

  if (e.Row.RowType == DataControlRowType.Header)
  {
    e.Row.TableSection = TableRowSection.TableHeader;
  }

  if (e.Row.RowType == DataControlRowType.DataRow)
  {
    //Get the value of column from the DataKeys using the RowIndex.
    int id = Convert.ToInt32(GridView1.DataKeys[e.Row.RowIndex].Values[0]);

    Credential credential = IspCredentialRepository.GetIspCredentialById(id);

    LinkButton linkButton = e.Row.FindControl("BtnStatus") as LinkButton;
    RadioButton radioButton1 = e.Row.FindControl("RadioButton1") as RadioButton;

    linkButton.Style.Add("font-weight", "bolder");
    linkButton.Style.Add("color", "red");

    //Cells index start from 0
    dramount += Convert.ToDouble(e.Row.Cells[4].Text);
    cramount += Convert.ToDouble(e.Row.Cells[5].Text);

    //Response.Write("sft_status : " + sft_status + " rtr_status : " + rtr_status + "<br />");


  }

  if (e.Row.RowType == DataControlRowType.Footer)
  {
    e.Row.Cells[4].Text = dramount.ToString("N2", new CultureInfo("bn-BD"));
    e.Row.Cells[5].Text = cramount.ToString("N2",new CultureInfo("bn-BD"));
  }

}




?>