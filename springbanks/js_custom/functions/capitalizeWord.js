function capWords(str){ //CAPITALIZE EACH LETTER OF THE FIRST WORD OF THE STRING. 
    var words = str.split(" "); 
    for (var i=0 ; i < words.length ; i++){ 
       var testwd = words[i]; 
       var firLet = testwd.substr(0,1); 
       var rest = testwd.substr(1, testwd.length -1) 
       words[i] = firLet.toUpperCase() + rest 
    }
     return words.join(" ");
 }