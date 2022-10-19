import { useParams, Link } from "react-router-dom";
import { useEffect } from "react";
import axios from "axios";
const UsuwanieUzytkownika = () => {
    const {id} = useParams();
    useEffect (()=>{
        UsunUzytkownika();
    },[]);
    
    const UsunUzytkownika = () =>{
        axios.post("http://localhost:80/zatwierdz/usun.php",JSON.stringify({
            id_pracownika: id})).then(function (response)
        {
                console.log(response.data);
        });
    }
    return ( 
        <div className="usuwanie">
            <h1>Usunięto użytkownika o id numer {id}</h1>
            <Link to="/admin">Powróc na stronę główną</Link>
        </div>
     );
}
 
export default UsuwanieUzytkownika;