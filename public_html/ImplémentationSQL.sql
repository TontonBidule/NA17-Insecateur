CREATE OR REPLACE TYPE typeObjet AS ENUM ('achetable','trouvable','donne');
CREATE OR REPLACE TYPE typeSexe AS ENUM ('masculin','feminin');
CREATE OR REPLACE TYPE typePokeball AS ENUM ('artisanale','classique');

CREATE OR REPLACE TABLE TypePokemon(
	nom varchar PRIMARY KEY);
	
CREATE OR REPLACE TABLE EspecePokemon(
	nom varchar PRIMARY KEY,
	numFamille integer,
	probaApparition float,
	probaCapture float,
	baseAttaque float,
	baseDefense float,
	baseSante float,
	capaciteCombatBase float,
	type1 varchar references TypePokemon(nom) NOT NULL,
	type2 varchar references TypePokemon(nom),
	evolution varchar references EspecePokemon(nom),
	CHECK(probaApparition>=0 AND probaApparition<=1 AND probaCapture>=0 AND probaCapture<=1)
	);
	
CREATE OR REPLACE TABLE Objet(
	nom varchar PRIMARY KEY,
	type typeObjet not null,
	description varchar,
	prixVente integer
);





CREATE OR REPLACE TABLE IndividuPokemon(
	nom varchar references EspecePokemon(nom),
	num integer,
	attaqueIV float,
	defenseIV float,
	santeIV float,
	capaciteCombat float,
	objetPorte varchar references Objet(nom),
	PRIMARY KEY(nom,num),
	CHECK(attaqueIV>=0 AND attaqueIV<=15 AND defenseIV>=0 AND defenseIV<=15 AND santeIV>=0 AND santeIV<=15)
	);

CREATE OR REPLACE TABLE Joueur(
	nom varchar PRIMARY KEY,
	email varchar unique,
	dateNaissance date not null,
	genre typeSexe not null,
	pays varchar not null,
	experienceCumulee integer,
	coord_latitude float,
	coord_longitude float,
	nbPokestopsVisitesAjd integer,
	nbPokemonsCapturesAjd integer,
	derniereConnexion date,
	pokeCoins integer,
	argent float,
	unique(coord_latitude, coord_longitude)
	
);

CREATE OR REPLACE TABLE Pokeball(
	nom varchar PRIMARY KEY references Objet(nom),
	type typePokeball
);

CREATE OR REPLACE TABLE PokemonSauvage(
	nom varchar,
	num integer,
	coord_latitude float,
	coord_longitude float,
	unique(coord_latitude,coord_longitude),
	PRIMARY KEY(nom,num),
	FOREIGN KEY(nom,num) REFERENCES IndividuPokemon(nom,num)
);

CREATE OR REPLACE TABLE PokemonCapture(
	nom varchar,
	num integer,
	dresseur varchar not null references Joueur(nom),
	pokeball varchar not null references Pokeball(nom),
	PRIMARY KEY(nom,num),
	FOREIGN KEY(nom,num) REFERENCES IndividuPokemon(nom,num)
);

CREATE OR REPLACE TABLE Arene(
	nom varchar PRIMARY KEY,
	photo varchar unique,
	coord_latitude float,
	coord_longitude float,
	unique(coord_latitude, coord_longitude)
);



CREATE OR REPLACE TABLE Pokestop(
	nom varchar PRIMARY KEY,
	photo varchar unique,
	coord_latitude float,
	coord_longitude float,
	unique(coord_latitude, coord_longitude)
);

CREATE OR REPLACE TABLE Shop(
	pays varchar PRIMARY KEY
);



CREATE OR REPLACE TABLE Potion(
	nom varchar PRIMARY KEY references Objet(nom),
	santeRestauree integer not null
);




CREATE OR REPLACE TABLE ParametresAdmin(
	distanceMaxPokestop integer,
	distanceMaxPokemon integer,
	maxCapture integer,
	maxPokestopsVisitables integer,
	valeurArgent float,
	PRIMARY KEY(distanceMaxPokestop,distanceMaxPokemon,maxCapture,maxPokestopsVisitables)
);

INSERT INTO ParametresAdmin VALUES(1,0,0,0,0);


CREATE OR REPLACE TABLE CombattreDans(
	arene varchar references Arene(nom),
	joueur varchar references Joueur(nom),
	PRIMARY KEY(arene,joueur)
);

CREATE OR REPLACE TABLE  Connaitre(
	joueur varchar references Joueur(nom),
	pokemon varchar references EspecePokemon(nom),
	PRIMARY KEY(joueur,pokemon)
);

CREATE OR REPLACE TABLE  Visiter(
	joueur varchar references Joueur(nom),
	pokestop varchar references Pokestop(nom),
	derniereVisite date,
	PRIMARY KEY(joueur,pokestop)
);

CREATE OR REPLACE TABLE Vendre(
	shop varchar references Shop(pays),
	objet varchar references Objet(nom),
	PRIMARY KEY(shop,objet)
);

CREATE OR REPLACE TABLE Posseder(
	joueur varchar references Joueur(nom),
	objet varchar references Objet(nom),
	quantite integer NOT NULL,
	PRIMARY KEY(joueur,objet)
);

CREATE OR REPLACE TABLE Proposer(
	pokestop varchar references Pokestop(nom),
	objet varchar references Objet(nom),
	quantite integer NOT NULL,
	PRIMARY KEY(pokestop,objet)
);

CREATE OR REPLACE TABLE EffectuerTransactionAvec(
	shop varchar references Shop(pays),
	joueur varchar references Joueur(nom),
	date date,
	argentDepense float,
	PRIMARY KEY(shop,joueur, date)
);

CREATE OR REPLACE FUNCTION PokemonPotentiels (pseudo text,lim float)RETURNS TABLE(nom VARCHAR,num int) AS $$
	SELECT PokemonSauvage.nom,PokemonSauvage.num
	FROM Joueur, PokemonSauvage 
	WHERE Joueur.nom=pseudo AND(SQRT(POWER(PokemonSauvage.coord_latitude::float-Joueur.coord_latitude::float,2)::float+ pow(PokemonSauvage.coord_longitude::float-Joueur.coord_longitude::float,2)::float)::float<=lim)
$$ LANGUAGE SQL;





CREATE OR REPLACE FUNCTION PokestopPotentiels (pseudo text,lim float)RETURNS TABLE(nom text) AS $$
	SELECT Pokestop.nom
	FROM Joueur, Pokestop
	WHERE Joueur.nom=pseudo AND(SQRT(POWER(Pokestop.coord_latitude::float-Joueur.coord_latitude::float,2)::float+ pow(Pokestop.coord_longitude::float-Joueur.coord_longitude::float,2)::float)::float<=lim)
$$ LANGUAGE SQL;

CREATE OR REPLACE FUNCTION ArenesPotentielles (pseudo text,lim float)RETURNS TABLE(nom text) AS $$
	SELECT Arene.nom
	FROM Joueur, Arene
	WHERE Joueur.nom=pseudo AND(SQRT(POWER(arene.coord_latitude::float-joueur.coord_latitude::float,2)::float+ pow(Arene.coord_longitude::float-Joueur.coord_longitude::float,2)::float)::float<=lim)
$$ LANGUAGE SQL;

CREATE OR REPLACE FUNCTION PokestopAttente (pseudo text,lim float)RETURNS TABLE(nom text, attente interval) AS $$
	SELECT pokestop,date_trunc('second', '00:01:00'::time-(CURRENT_TIMESTAMP-derniereVisite)::time)
	FROM Visiter
	INNER JOIN 
	(SELECT Pokestop.nom
	FROM Joueur, Pokestop
	WHERE Joueur.nom=pseudo AND(SQRT(POWER(Pokestop.coord_latitude::float-Joueur.coord_latitude::float,2)::float+ pow(Pokestop.coord_longitude::float-Joueur.coord_longitude::float,2)::float)::float<=lim)) AS PokestopsAlentours ON Visiter.pokestop=PokestopsAlentours.nom
	WHERE (CURRENT_TIMESTAMP-Visiter.derniereVisite<interval '1 minute');
$$ LANGUAGE SQL;

CREATE PROCEDURE ajoutStock(bool integer,pseudo text, objet text, quantite integer) 
IF bool==0
BEGIN
	INSERT INTO Posseder VALUES('pseudo','objet',quantite)
END
ELSE
BEGIN
	UPDATE Posseder
	SET Posseder.quantite=Posseder.quantite+quantite
	WHERE Posseder.joueur=$pseudo AND Posseder.objet=$objet
END;

CREATE OR REPLACE FUNCTION ShopPotentiel (pseudo text)RETURNS TABLE(pays VARCHAR) AS $$
	
	SELECT Shop.pays FROM Shop INNER JOIN Joueur ON Joueur.pays=Shop.pays WHERE Joueur.nom='Arobaz'
; $$ LANGUAGE SQL;


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

INSERT INTO ParametresAdmin VALUES('10','10','10','10','10');
INSERT INTO TypePokemon VALUES ('feu');
INSERT INTO TypePokemon VALUES ('eau');
INSERT INTO EspecePokemon VALUES ('Dracaufeu',1,0.2,0.2,0.2,0.2,0.2,0.2,'feu',NULL,NULL);
INSERT INTO EspecePokemon VALUES ('Reptincel',1,0.2,0.2,0.2,0.2,0.2,0.2,'feu',NULL,'Dracaufeu');
INSERT INTO EspecePokemon VALUES ('Salameche',1,0.2,0.2,0.2,0.2,0.2,0.2,'feu',NULL,'Reptincel');
INSERT INTO EspecePokemon VALUES ('Tortank',1,0.2,0.2,0.2,0.2,0.2,0.2,'eau',NULL,NULL);
INSERT INTO EspecePokemon VALUES ('Carabaffe',1,0.2,0.2,0.2,0.2,0.2,0.2,'eau',NULL,'Tortank');
INSERT INTO EspecePokemon VALUES ('Carapuce',1,0.2,0.2,0.2,0.2,0.2,0.2,'eau',NULL,'Carabaffe');
INSERT INTO IndividuPokemon VALUES ('Carapuce',1,0,0,0,0,NULL);
INSERT INTO IndividuPokemon VALUES ('Salameche',2,0,0,0,0,NULL);
INSERT INTO IndividuPokemon VALUES ('Dracaufeu',3,0,0,0,0,NULL);
INSERT INTO PokemonSauvage VALUES ('Carapuce',1,15,20);
INSERT INTO PokemonSauvage VALUES ('Salameche',2,20,40);
INSERT INTO PokemonSauvage VALUES ('Dracaufeu',3,5,10);
INSERT INTO Pokestop VALUES ('Boulangerie',NULL,12,10);
INSERT INTO Pokestop VALUES ('Piscine',NULL,20,5);

INSERT INTO Objet VALUES ('Potion de soin mineure', 'achetable', 'objet nul', 50);
INSERT INTO Objet VALUES ('Potion de soin majeure', 'achetable', 'objet nul', 100);
INSERT INTO Objet VALUES ('Super bonbon','achetable','et glou et glou',20);
INSERT INTO Objet VALUES ('Repousse','achetable','lssez moi trkl pt1n',30);
INSERT INTO Potion VALUES ('Potion de soin mineure', 40);
INSERT INTO Potion VALUES ('Potion de soin majeure', 80);
INSERT INTO Proposer VALUES ('Boulangerie','Repousse',2);
INSERT INTO Proposer VALUES ('Boulangerie','Super bonbon',5);
INSERT INTO Proposer VALUES ('Piscine','Repousse',10);
INSERT INTO Proposer VALUES ('Piscine','Super bonbon',3);
INSERT INTO Vendre VALUES ('France','Repousse');
INSERT INTO Vendre VALUES ('France','Super bonbon');

//exemple d'INSERT pour effectuer tous les tests nécessaires '
INSERT INTO Joueur VALUES
('Mare','benjami.mare@etu.utc.fr',to_date('23051996','DDMMYYYY'),'masculin','France',0,0,0,0,0,to_date('31122016','DDMMYYYY'),0,0);

INSERT INTO Joueur VALUES
('Arobaz', 'arobaz@etu.utc.fr', to_date ('12121996', 'DDMMYYYY'), 'masculin', 'France', 0, 0, 0, 0, 0, to_date('31122016', 'DDMMYYYY'), 0, 0);

