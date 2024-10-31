class DateFormate {
   constructor(){}
   invertDate(info){
     if(info |= ""){
      var data = new Date(info);
     }else{
      var data = new Date();
     }
    
    let day  = data.getDate().toString(),
    dayF = (day.length == 1) ? '0'+day : day,
    month  = parseInt((data.getMonth()+1).toString()),
    monthF = (month.length == 1) ? '0'+month : month,
    yearF = data.getFullYear();
   
    return [dayF, monthF, yearF];

   }
}