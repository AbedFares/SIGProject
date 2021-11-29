package projet.sig;

import org.springframework.data.jpa.repository.JpaRepository;
import org.springframework.data.jpa.repository.Query;
import org.springframework.data.relational.core.sql.In;
import org.springframework.data.repository.query.Param;
import org.springframework.stereotype.Repository;

import java.util.Map;

@Repository
public interface SigConnexionRepository extends JpaRepository<SigConnexion,Long> {
    @Query(value = "insert into sig_connexion (types ,debit, satisfait,fournisseur,etat,longt,altitude,ville) values ( :types, :debit, :satisfait,:fournisseur,:etat,:longt,:altitude,:ville)",
            nativeQuery = true)
    void insertSig(@Param("types") String types, @Param("debit") String debit,
                   @Param("satisfait") String satisfait, @Param("fournisseur") String fournisseur, @Param("etat") String etat,
                   @Param("longt") String longt, @Param("altitude") String altitude, @Param("ville") String ville);
}
