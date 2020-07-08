
/*
	Edit - Preferences - SQL Editor - Uncheck Safe Updates
        Query - Reconnect  to Server
*/
DROP TABLE IF EXISTS requiredEventDrinks;
DROP TABLE IF EXISTS EventInfo;
DROP TABLE IF EXISTS Beers;
DROP TABLE IF EXISTS Breweries;

CREATE TABLE IF NOT EXISTS EventInfo (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    title VARCHAR(50) NOT NULL,
    eventStart DATETIME NOT NULL,
    eventEnd DATETIME NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Breweries (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    brewerName VARCHAR(50) NOT NULL,
    brewerState VARCHAR(20) NOT NULL,
    brewerCity VARCHAR(20) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS Beers (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    beerName VARCHAR(50) NOT NULL,
    brewerID INT NOT NULL REFERENCES Brewery(id),
    style VARCHAR(50) NOT NULL
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

CREATE TABLE IF NOT EXISTS RequiredEventDrinks (
    id INT UNSIGNED AUTO_INCREMENT NOT NULL PRIMARY KEY,
    EventId INT NOT NULL REFERENCES EventInfo(id),
    requiredDrink INT NULL REFERENCES Beers(id),
    requiredStyle VARCHAR(50) NULL,
    requiredBrewer INT Null REFERENCES Brewery(id)
) ENGINE=InnoDB DEFAULT CHARSET=utf8 COLLATE=utf8_unicode_ci AUTO_INCREMENT=1;

INSERT INTO Breweries (brewerName, brewerState, brewerCity) VALUES 
('Grey Sail', 'Rhode Island', 'Westerly'),
('Whalers', 'Rhode Island', 'Wakefield'),
("Beer'd", 'Connectiuct', 'Stonington');

INSERT INTO Beers (beerName, brewerID, style) VALUES 
("Captain's Daughter", 1, 'IPA'),
('Flagship', 1, 'Ale'),
("Flying Jenny", 1, 'EPA'),
("HazyDay", 1, 'BELGIAN-STYLE WIT'),
("Pour Judgement", 1, 'IPA'),
("Rise", 2, 'APA'),
("East Coast IPA", 2, 'IPA');