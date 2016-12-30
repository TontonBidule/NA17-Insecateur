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

