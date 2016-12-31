CREATE OR REPLACE FUNCTION age(IN nomJoueur VARCHAR) RETURNS DOUBLE PRECISION AS $$
	SELECT trunc(((DATE_PART('year', current_date) - DATE_PART('year', j.dateNaissance))*12 + (DATE_PART('month', current_date) - DATE_PART('month', j.dateNaissance)))/12)
	FROM joueur j
	WHERE j.nom=nomJoueur;
$$ LANGUAGE SQL;
CREATE OR REPLACE FUNCTION enregistrerLocalisation(IN latitude INTEGER, IN longitude INTEGER, IN nomJoueur VARCHAR) RETURNS VOID AS
	'UPDATE Joueur j
	SET coord_latitude=latitude, coord_longitude=longitude
	WHERE j.nom=nomJoueur'
LANGUAGE SQL;
CREATE OR REPLACE FUNCTION puissance(numPokemon INTEGER, nomPokemon VARCHAR) RETURNs FLOAT AS $$
	SELECT ((|/(baseAttaque + attaqueIV))*(|/(baseDefense+defenseIV))*(|/(baseSante+santeIV))) AS puissance 
	FROM IndividuPokemon ip, EspecePokemon ep
	WHERE ip.num=numPokemon
	AND ip.nom=nomPokemon
	AND ip.nom=ep.nom;
$$ LANGUAGE SQL;
CREATE OR REPLACE FUNCTION sante(numPokemon INTEGER, nomPokemon VARCHAR) RETURNS FLOAT AS $$
	SELECT (santeIV+baseSante) AS sante
	FROM IndividuPokemon ip, EspecePokemon ep
	WHERE ip.num=numPokemon
	AND ip.nom=nomPokemon
	AND ep.nom=ip.nom;
$$ LANGUAGE SQL;
CREATE OR REPLACE FUNCTION prixArgentReel(nomObjet VARCHAR) RETURNS FLOAT AS $$
	SELECT pa.valeurArgent * o.prixVente
	FROM Objet o, ParametresAdmin pa
	WHERE o.nom=nomObjet;
$$ LANGUAGE SQL;

