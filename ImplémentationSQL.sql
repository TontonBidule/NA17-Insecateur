



create table TypePokemon(
	nom varchar primary key);
	
create table EspecePokemon(
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

create table IndividuPokemon(
	nom varchar references EspecePokemon(nom),
	num integer,
	attaqueIV float,
	defenseIV float,
	santeIV float,
	capaciteCombat float,
	objetPorte varchar references Objet(nom),
	PRIMARY KEY(nom,num)
	CHECK(attaqueIV>=0 AND attaqueIV<=15 AND defenseIV>=0 AND defenseIV<=15 AND santeIV>=0 AND santeIV<=15)
	);

####19####
create table pokemonSauvage(
	nom varchar references IndividuPokemon(nom),
	num integer references IndividuPokemon(num),
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
	primary key(nom,num),
);
####19####
create table pokemonCapture(
	nom varchar references IndividuPokemon(nom),
	num integer references IndividuPokemon(num),
	dresseur varchar not null references joueur(nom),
	pokeball varchar not null references Pokeball(nom),
	primary key(nom,num),
);

####3####
create table joueur(
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
	pokeCoins integer, #Oubli dans le MLD
	argent float, #Oubli dans le MLD
	unique(coord_lattitude, coord_longitude),
	check(genre = "masculin" or genre = "feminin")
	
);

####4#####
create table Arene(
	nom varchar primary key,
	photo varchar unique,
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
);
####5######
create table Pokestop(
	nom varchar primary key,
	photo varchar unique,
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
);
####6######
create table Shop(
	pays varchar primary key
);

create table Objet(
	nom varchar primary key,
	type varchar not null,
	description varchar,
	prixVente integer,
	check(type = "achetable" or type="trouvable" or type="donne")
);

create table Potion(
	nom varchar primary key references Objet(nom),
	santeRestauree integer not null
);

create table Pokeball(
	nom varchar primary key references Objet(nom),
	type varchar,
	check(type = "classique" or type="artisanale"
);

CREATE TABLE ParametresAdmin(
	distanceMaxPokestop integer,
	distanceMaxPokemon integer,
	maxCapture integer,
	maxPokestopsVisitables integer,
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
	shop REFERENCES Shop(pays),
	objet REFERENCES Objet(nom),
	PRIMARY KEY(shop,objet)
);

CREATE TABLE Posseder(
	joueur REFERENCES Joueur(nom),
	objet REFERENCES Objet(nom),
	quantite integer NOT NULL,
	PRIMARY KEY(joueur,objet)
);

CREATE TABLE Proposer(
	pokestop REFERENCES Pokestop(nom),
	objet REFERENCES Objet(nom),
	quantite integer NOT NULL,
	PRIMARY KEY(joueur,objet)
);

CREATE TABLE EffectuerTransactionAvec(
	shop REFERENCES Shop(pays),
	joueur REFERENCES Joueur(nom),
	date date,
	argentDepense float,
	PRIMARY KEY(shop,joueur)
);
