package projet.sig;



import org.hibernate.annotations.Generated;
import org.hibernate.annotations.Type;

import javax.persistence.*;
import java.util.*;
import java.util.List;
@Entity
public class SigConnexion {




    private String etat;
    private String debit;
    private String fournisseur;
    private String types;
    private String satisfait;
    private String altitude;
    private String longt;
    @Id
@GeneratedValue(strategy = GenerationType. IDENTITY)
    private Integer id;

    public SigConnexion() {

    }

    public String getLongt() {
        return longt;
    }

    public void setLongt(String longt) {
        this.longt = longt;
    }

    public String getVille() {
        return ville;
    }

    public void setVille(String ville) {
        this.ville = ville;
    }

    private String ville;


    public String getAltitude() {
        return altitude;
    }

    public void setAltitude(String altitude) {
        this.altitude = altitude;
    }




    public String getDebit() {
        return debit;
    }

    public void setDebit(String debit) {
        this.debit = debit;
    }


    public String getFournisseur() {
        return fournisseur;
    }

    public void setFournisseur(String fournisseur) {
        this.fournisseur = fournisseur;
    }



    public String getTypes() {
        return types;
    }

    public void setTypes(String type) {
        this.types = type;
    }



    public String getEtat() {
        return etat;
    }

    public void setEtat(String etat) {
        this.etat = etat;
    }



    public String getSatisfait() {
        return satisfait;
    }

    public void setSatisfait(String satisfait) {
        this.satisfait = satisfait;
    }


    public void setId(Integer id) {
        this.id = id;
    }


    public Integer getId() {
        return id;
    }
}
