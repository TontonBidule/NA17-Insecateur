
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
DROP TABLE Pokemon CASCADE;
DROP TABLE ParametresAdmin CASCADE;
DROP TABLE CombattreDans CASCADE;
DROP TABLE Connaitre CASCADE;
DROP TABLE Visiter CASCADE;
DROP TABLE Vendre CASCADE;
DROP TABLE Posseder CASCADE;
DROP TABLE Proposer CASCADE;
DROP TABLE EffectuerTransactionAvec CASCADE;

BEGIN;

CREATE TABLE TypePokemon(
	nom varchar primary key);
	
CREATE TABLE EspecePokemon(
	nom varchar primary key,
	numFamille integer,
	probaApparition float,
	probaCapture float,
	baseAttaque float,
	baseDefense float,
	baseSante float,
	capaciteCombatBase float,
	type1 varchar references TypePokemon(nom),
	type2 varchar references TypePokemon(nom),
	evolution varchar references EspecePokemon(nom),
	CHECK(probaApparition>=0 AND probaApparition<=1 AND probaCapture>=0 AND probaCapture<=1)
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


CREATE TABLE PokemonSauvage(
	nom varchar references IndividuPokemon(nom),
	num integer references IndividuPokemon(num),
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude),
	primary key(nom,num)
);

CREATE TABLE PokemonCapture(
	nom varchar references IndividuPokemon(nom),
	num integer references IndividuPokemon(num),
	dresseur varchar not null references joueur(nom),
	pokeball varchar not null references Pokeball(nom),
	primary key(nom,num)
);


CREATE TABLE Joueur(
	nom varchar primary key,
	email varchar unique,
	dateNaissance date not null,
	genre varchar not null,
	pays varchar not null,
	experienceCumulee integer,
	coord_lattitude float,
	coord_longitude float,
	nbPokestopsVisitesAjd integer,
	nbPokemonsCapturesAjd integer,
	derniereConnexion date,
	pokeCoins integer,
	argent float,
	unique(coord_lattitude, coord_longitude),
	check(genre = "masculin" or genre = "feminin")
	
);


CREATE TABLE Arene(
	nom varchar primary key,
	photo varchar unique,
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
);

CREATE TABLE Pokestop(
	nom varchar primary key,
	photo varchar unique,
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
);

CREATE TABLE Shop(
	pays varchar primary key
);

CREATE TABLE Objet(
	nom varchar primary key,
	type varchar not null,
	description varchar,
	prixVente integer,
	check(type = "achetable" or type="trouvable" or type="donne")
);

CREATE TABLE Potion(
	nom varchar primary key references Objet(nom),
	santeRestauree integer not null
);

CREATE TABLE Pokeball(
	nom varchar primary key references Objet(nom),
	type varchar,
	check(type = "classique" or type="artisanale")
);

CREATE TABLE ParametresAdmin(
	distanceMaxPokestop integer,
	distanceMaxPokemon integer,
	maxCapture integer,
	maxPokestopsVisiTABLEs integer,
	PRIMARY KEY(distanceMaxPokestop,distanceMaxPokemon,maxCapture,maxPokestopsVisiTABLEs)
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
	PRIMARY KEY(joueur,objet)
);

CREATE TABLE EffectuerTransactionAvec(
	shop varchar references Shop(pays),
	joueur varchar references Joueur(nom),
	date date,
	argentDepense float,
	PRIMARY KEY(shop,joueur)
);

COMMIT;
