using (var context = new studentlistContext())
{

    #To Create Country 
    Countries country = new Countries();
    country.Name = "Pakistan";
    context.Countries.Add(country);
    context.SaveChanges();

     #To Update Country 

    Countries country = context.Countries.Where(country => country.Id == 3).FirstOrDefault();
    country.Name = "Pak";
    context.SaveChanges();

     #To Remove Country 

    Countries country = context.Countries.Where(country => country.Id == 3).FirstOrDefault();
    if (country != null)
    {
        context.Countries.Remove(country);
        context.SaveChanges();
    }


    // To display List of data
        return context.Countries.ToList();

    // To display single object   
        Countries country = context.Countries.Where(country => country.Id == id).FirstOrDefault();
        return country;


    
}