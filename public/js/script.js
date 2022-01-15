var validation = {
    sender : false,
    receiver : false,
    label : false,
    price : false,
    description : false,
    firstname : false,
    lastname :  false,
    postalcode : false,
    dateofbirth : false,
};

var submitDisabled = false;
var formName = "";
const submitButton = $("#submitButton")[0];

/*
    ###WALIDACJA

    ##OGOLNE
    - sprawdzanie czy input jest przesyłany // istnieje w kontekście,
    - sprawdzanie czy input pusty ( spacje nie koligują ze sprawdzaniem długości inputa ),
    - sprawdzanie czy input ma przypisany name,
    - sprawdzanie czy nazwa inputu jest zgodna,
    
    - blokowanie przycisku SUBMIT podczas, gdy walidacja jednego elementu jest nieprawidłowa,
    - odlobkowywanie przycisku SUBMIT podczas, gdy walidacja jest prawidłowa dla wszystkich elementów,

    ##CENA
    - sprawdzanie czy cena mniejsza niz zero,
    - sprawdzanie czy cena nie jest zapisana literami,

    ##TEXT
    - sprawdzanie czy nie zaczyna się od cyfry,
    - sprawdzanie czy nie jest za długa,

*/

function validate( source ){
    var errormessage = "";
        if(formName == ""){
            if(
                source.name == "sender"
            ||  source.name == "receiver"
            ||  source.name == "label"
            ||  source.name == "price"
            ||  source.name == "description"
            ){
                formName = "gift";
            }
            else{
                formName = "person";
            }
        }

    if( source != null && source.name != "" ){
        if( validation[source.name] != false && validation[source.name] != true ) { throw( new Error("Wystapił nieoczekiwany błąd/y! Upewnij się, że NAZWA istnieje w kontekście.") ) }

        if( source.value.trim().length > 0 ){
            if( source.name == "price" ){
                if ( !isNaN(source.value) ){
                    if( source.value >= 0 ){
                        validation[source.name] = true;
                    }else{
                        validation[source.name] = false;
                        errormessage = "Cena musi wynosić więcej niż 0!"
                    }
                }else{
                    validation[source.name] = false;
                    errormessage = "Cena musi być liczbą!";
                }
            }else{
                if( isNaN(source.value.trim().charAt(0)) ){
                    validation[source.name] = true;
                }else{
                    validation[source.name] = false;
                    errormessage = "Tekst nie może zaczynac się od liczby!";
                }
            }
        }else{
            validation[source.name] = false;
            errormessage = "Tekst nie może być pusty!"
        }
    }
    else{
        throw( new Error("Wystapił nieoczekiwany błąd/y! Upewnij się, że NAZWA istnieje w kontekście.") )
    }

    if( validation[source.name] ) { errormessage = ""; }
    else { submitDisabled = true; }

    if(formName == "gift"){
        if(
            validation["sender"]
        &&  validation["receiver"]
        &&  validation["label"]
        &&  validation["price"]
        &&  validation["description"]
        ){
            submitDisabled = false;
        }else{
            submitDisabled = true;
        }
    }else if(formName == "person"){
        if(
            validation["firstname"]
        &&  validation["lastname"]
        &&  validation["postalcode"]
        &&  validation["dateofbirth"]
        ){
            submitDisabled = false;
        }else{
            submitDisabled = true;
        }
    }

    $( "#"+source.name+"_error" ).innerHTML = errormessage;
    submitButton.disabled = submitDisabled;
}