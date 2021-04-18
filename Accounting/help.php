<?php  

Chart Of accounts ==>

=> Assets(Fixedasset(), Currentasset()),
=> Liabilities(CurrrentLiabilities(), CaptalAccounts()),
=> Income(DirectIncome(), IndirectIncome()),
=> Expense(DirectExpense(), IndirectExpense())



// Balance Sheet 

Liabilities() == Assets();

Liabilities((Sum Of Liabilities + Profit & Loss (OpeningBalance/openingNetProf + Current Period/Net Profit))) === Assets ( Fixed Assets (Sum Of Fixed Assets) + Current Assets(Closing Stock + Cash-in-hand + Cash at Bank)
)


//Profit & Loss 

Expense() === Income()


GrossLossExp = Direct Expense() + Purchase A/C + Opening Stock;

GrossLossInc1 = Direct Income() + Sales A/C + Closing Stock;

GrossLossC/O = GrossLossExp - GrossLossInc1;

GrossLossC/O = GrossLoss B/F

GrossLossInc = Direct Income() + Sales A/C + Closing Stock + GrossLossC/O;


GrossLossExp() === GrossLossInc()


#Net Profit = Indirect Income - (GrossLoss B/F + Indirect Expense)

Net Profit = ((indincome - (grosslossbf)) - (indexpense)) as netprofit


Total Expense = (GrossLoss B/F + Indirect Expense) + Net Profit;

Total Income = Indirect Income;

Total Expense() === Total Income()

