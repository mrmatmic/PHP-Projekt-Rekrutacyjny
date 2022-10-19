import { useState,useEffect } from "react";
import { useParams } from "react-router-dom";
import axios from "axios";
import { Link } from "react-router-dom";
const EdytujUzytkownika = () => {
    const [uzytkownicy,setUzytkownicy]= useState([]);
    const {id} = useParams();
    useEffect (()=>{
        DostanUzytkownika();
    },[]);
    
    const DostanUzytkownika = () =>{
        axios.post("http://localhost:80/zatwierdz/edytuj.php",JSON.stringify({
            id_pracownika: id})).then(function (response)
        {
                setUzytkownicy(response.data);
                console.log(response.data);
        });
    }

    return (  
        <div className="edytujuzytkownika">
            <h1>Blog - {id}</h1> 
            
                    {uzytkownicy.map((uzytkownik,key) =>
                        <div className="wstaw" key={key}>
                            <input type="text" value={uzytkownik.imie}/>
                            <input type="text" value={uzytkownik.nazwisko}/>
                            <input type="text" value={uzytkownik.email}/>
                            <input type="text" value={uzytkownik.opis}/>
                            <input type="text" value={uzytkownik.stanowisko}/>
                        </div>
                            
                    )}
               
        </div>
    );
}
 
export default EdytujUzytkownika;