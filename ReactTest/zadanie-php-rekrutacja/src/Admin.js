import { useEffect, useState } from "react";
import axios from "axios";
import { Link } from "react-router-dom";

const Admin = () => {
    const [uzytkownicy,setUzytkownicy]= useState([]);

    useEffect (()=>{
        DostanUzytkownikow();
    },[]);

    const DostanUzytkownikow = () =>{
        axios.get("http://localhost:80/zatwierdz/wszyscy.php").then(function (response)
        {
                setUzytkownicy(response.data);
                console.log(response.data);
        });
    }

    return ( 
        <div className="admin">
            <h2>To jest strona administratora</h2>
            <table>
                <thead>
                    <tr>
                        <th>#</th>
                        <th>Imię</th>
                        <th>Nazwisko</th>
                        <th>E-mail</th>
                        <th>Opis</th>
                        <th>Stanowisko</th>
                        <th>Edytuj</th>
                        <th>Usuń</th>
                    </tr>
                </thead>
                <tbody>
                    {uzytkownicy.map((uzytkownik,key) =>
                        <tr key={key}>
                            <td>{uzytkownik.id_pracownika}</td>
                            <td>{uzytkownik.imie}</td>
                            <td>{uzytkownik.nazwisko}</td>
                            <td>{uzytkownik.email}</td>
                            <td>{uzytkownik.opis}</td>
                            <td>{uzytkownik.stanowisko}</td>
                            <td><Link to={`/admin/${uzytkownik.id_pracownika}`}><button>Edytuj</button></Link></td>
                            <td><Link to={`/admin/delete/${uzytkownik.id_pracownika}`}><button>Usuń</button></Link></td>
                        </tr>
                    )}
                </tbody>
            </table>
        </div>
     );
}
 
export default Admin;