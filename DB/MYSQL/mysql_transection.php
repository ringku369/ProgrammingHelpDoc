<?php 

//START TRANSACTION;
//COMMIT;
//ROLLBAC;


/**
 * Connect to MySQL and instantiate the PDO object.
 * Set the error mode to throw exceptions and disable emulated prepared statements.
 */
$pdo = new PDO('mysql:host=localhost;dbname=test', 'root', '', array(
    PDO::ATTR_ERRMODE => PDO::ERRMODE_EXCEPTION,
    PDO::ATTR_EMULATE_PREPARES => false
));
 
 
//We are going to assume that the user with ID #1 has paid 10.50.
$userId = 1;
$paymentAmount = 10.50;
 
 
//We will need to wrap our queries inside a TRY / CATCH block.
//That way, we can rollback the transaction if a query fails and a PDO exception occurs.
try{
 
    //We start our transaction.
    $pdo->beginTransaction();
 
 
    //Query 1: Attempt to insert the payment record into our database.
    $sql = "INSERT INTO payments (user_id, amount) VALUES (?, ?)";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            $userId, 
            $paymentAmount,
        )
    );
    
    //Query 2: Attempt to update the user's profile.
    $sql = "UPDATE users SET credit = credit + ? WHERE id = ?";
    $stmt = $pdo->prepare($sql);
    $stmt->execute(array(
            $paymentAmount, 
            $userId
        )
    );
    
    //We've got this far without an exception, so commit the changes.
    $pdo->commit();
    
} 
//Our catch block will handle any exceptions that are thrown.
catch(Exception $e){
    //An exception has occured, which means that one of our database queries
    //failed.
    //Print out the error message.
    echo $e->getMessage();
    //Rollback the transaction.
    $pdo->rollBack();
}




// Laravel transection
// 

use Eod;

$exchange = Eod::exchange();

// Save CSV to specific path
$exchange->symbol($this->exchangeCode)->save(storage_path($csvPath), true);
$exchangeSymbol = fopen(storage_path($csvPath), 'r');

if ($exchangeSymbol !== false) 
{
    // Begin Transaction
    DB::beginTransaction();
  
    try 
    {
        // Delete data from table
        $securities = AllSecurity::where('country', $this->exchangeCode)->delete();
        $rowData = [];
        
        // Read CSV
        while (($data = fgetcsv($exchangeSymbol)) !== false) 
        {
            if (isset($data[1])) 
            {
                $symbol_ticker = $data[0] . '.' . $data[2];

                $rowData[] = [
                    'symbol' => $data[0],
                    'name' => $data[1],
                    'country' => $data[2],
                    'exchange' => $data[3],
                    'currency' => $data[4],
                    'symbol_ticker' => $symbol_ticker,
                    'created_at' => $now,
                    'updated_at' => $now,
                ];

                if (count($rowData) == 10000) 
                {
                    DB::table('all_securities')->insert($rowData);
                    unset($rowData);
                }
            }
        }

        if (isset($rowData) && count($rowData) > 0) 
        {
            DB::table('all_securities')->insert($rowData);
            unset($rowData);
        }
        
        // Commit Transaction
        DB::commit();
    } catch (\Exception $e) {
        // Rollback Transaction
        DB::rollback();
    }
  
    fclose($exchangeSymbol);
}



# Example 2 
# 
# 

DB::beginTransaction();
try {
    $project = Project::find($id);
    $project->users()->detach();
    $project->delete();
    DB::commit();
} catch (\Exception $ex) {
    DB::rollback();
    return response()->json(['error' => $ex->getMessage()], 500);
}