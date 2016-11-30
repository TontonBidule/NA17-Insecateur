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
	unique(coord_lattitude, coord_longitude),
	check(genre = "masculin" or genre = "feminin")
	
);

####4#####
create table arene(
	nom varchar primary key,
	photo varchar unique,
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
);
####5######
create table pokestop(
	nom varchar primary key,
	photo varchar unique,
	coord_lattitude float,
	coord_longitude float,
	unique(coord_lattitude, coord_longitude)
);
####6######
create table shop(
	pays varchar primary key
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
	pokeball varchar not null references Pokeball(nom),
	dresseur varchar not null references joueur(nom),
	primary key(nom,num),
);