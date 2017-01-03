
DROP TABLE TypePokemon CASCADE;
DROP TABLE EspecePokemon CASCADE;
DROP TABLE IndividuPokemon CASCADE;
DROP TABLE PokemonSauvage CASCADE;
DROP TABLE PokemonCapture CASCADE;
DROP TABLE Joueur CASCADE;
DROP TABLE Arene CASCADE;
DROP TABLE Pokestop CASCADE;
DROP TABLE Shop CASCADE;
DROP TABLE Objet CASCADE;
DROP TABLE Potion CASCADE;
DROP TABLE Pokeball CASCADE;
DROP TABLE ParametresAdmin CASCADE;
DROP TABLE CombattreDans CASCADE;
DROP TABLE Connaitre CASCADE;
DROP TABLE Visiter CASCADE;
DROP TABLE Vendre CASCADE;
DROP TABLE Posseder CASCADE;
DROP TABLE Proposer CASCADE;
DROP TABLE EffectuerTransactionAvec CASCADE;
DROP TYPE typeObjet;
DROP TYPE typeSexe;
DROP TYPE typePokeball;

CREATE TYPE typeObjet AS ENUM ('achetable','trouvable','donne');
CREATE TYPE typeSexe AS ENUM ('masculin','feminin');
CREATE TYPE typePokeball AS ENUM ('artisanale','classique');

CREATE TABLE TypePokemon(
	nom varchar PRIMARY KEY);
	
CREATE TABLE EspecePokemon(
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
	
CREATE TABLE Objet(
	nom varchar PRIMARY KEY,
	type typeObjet not null,
	description varchar,
	prixVente integer
);

CREATE TABLE IndividuPokemon(
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

CREATE TABLE Joueur(
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

CREATE TABLE Pokeball(
	nom varchar PRIMARY KEY references Objet(nom),
	type typePokeball
);

CREATE TABLE PokemonSauvage(
	nom varchar,
	num integer,
	coord_latitude float,
	coord_longitude float,
	unique(coord_latitude,coord_longitude),
	PRIMARY KEY(nom,num),
	FOREIGN KEY(nom,num) REFERENCES IndividuPokemon(nom,num)
);

CREATE TABLE PokemonCapture(
	nom varchar,
	num integer,
	dresseur varchar not null references Joueur(nom),
	pokeball varchar not null references Pokeball(nom),
	PRIMARY KEY(nom,num),
	FOREIGN KEY(nom,num) REFERENCES IndividuPokemon(nom,num)
);





CREATE TABLE Arene(
	nom varchar PRIMARY KEY,
	photo varchar unique,
	coord_latitude float,
	coord_longitude float,
	unique(coord_latitude, coord_longitude)
);

CREATE TABLE Pokestop(
	nom varchar PRIMARY KEY,
	photo varchar unique,
	coord_latitude float,
	coord_longitude float,
	unique(coord_latitude, coord_longitude)
);

CREATE TABLE Shop(
	pays varchar PRIMARY KEY
);



CREATE TABLE Potion(
	nom varchar PRIMARY KEY references Objet(nom),
	santeRestauree integer not null
);



CREATE TABLE ParametresAdmin(
	distanceMaxPokestop integer,
	distanceMaxPokemon integer,
	maxCapture integer,
	maxPokestopsVisitables integer,
	valeurArgent float,
	PRIMARY KEY(distanceMaxPokestop,distanceMaxPokemon,maxCapture,maxPokestopsVisitables)
);


CREATE TABLE CombattreDans(
	arene varchar references Arene(nom),
	joueur varchar references Joueur(nom),
	PRIMARY KEY(arene,joueur)
);

CREATE TABLE  Connaitre(
	joueur varchar references Joueur(nom),
	pokemon varchar references EspecePokemon(nom),
	PRIMARY KEY(joueur,pokemon)
);

CREATE TABLE  Visiter(
	joueur varchar references Joueur(nom),
	pokestop varchar references Pokestop(nom),
	derniereVisite date,
	PRIMARY KEY(joueur,pokestop)
);

CREATE TABLE Vendre(
	shop varchar references Shop(pays),
	objet varchar references Objet(nom),
	PRIMARY KEY(shop,objet)
);

CREATE TABLE Posseder(
	joueur varchar references Joueur(nom),
	objet varchar references Objet(nom),
	quantite integer NOT NULL,
	PRIMARY KEY(joueur,objet)
);

CREATE TABLE Proposer(
	pokestop varchar references Pokestop(nom),
	objet varchar references Objet(nom),
	quantite integer NOT NULL,
	PRIMARY KEY(pokestop,objet)
);

CREATE TABLE EffectuerTransactionAvec(
	shop varchar references Shop(pays),
	joueur varchar references Joueur(nom),
	date date,
	argentDepense float,
	PRIMARY KEY(shop,joueur)
);

CREATE OR REPLACE FUNCTION PokemonPotentiels 
(pseudo text,
lim float)
RETURNS TABLE(nom text,num int) AS
$$
SELECT PokemonSauvage.nom,PokemonSauvage.num
FROM Joueur, PokemonSauvage 
WHERE Joueur.nom=pseudo AND(SQRT(POWER(PokemonSauvage.coord_latitude::float-Joueur.coord_latitude::float,2)::float+ pow(PokemonSauvage.coord_longitude::float-Joueur.coord_longitude::float,2)::float)::float<=lim)$$ LANGUAGE SQL;

CREATE OR REPLACE FUNCTION PokestopPotentiels 
(pseudo text,
lim float)
RETURNS TABLE(nom text) AS
$$
SELECT Pokestop.nom
FROM Joueur, Pokestop
WHERE Joueur.nom=pseudo AND(SQRT(POWER(Pokestop.coord_latitude::float-Joueur.coord_latitude::float,2)::float+ pow(Pokestop.coord_longitude::float-Joueur.coord_longitude::float,2)::float)::float<=lim)$$ LANGUAGE SQL;


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

