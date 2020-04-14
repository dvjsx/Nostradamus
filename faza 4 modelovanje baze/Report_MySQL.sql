
CREATE TABLE Admin
(
	IdA                  INTEGER NOT NULL
);

ALTER TABLE Admin
ADD CONSTRAINT XPKAdmin PRIMARY KEY (IdA);

CREATE TABLE Daje_Ocenu
(
	IdK                  INTEGER NOT NULL,
	IdP                  INTEGER NOT NULL,
	Ocena                decimal(10,2) NULL
);

ALTER TABLE Daje_Ocenu
ADD CONSTRAINT XPKKorisnik_Predvidjanje_Ocena PRIMARY KEY (IdK,IdP);

CREATE TABLE Ideja
(
	IdK                  INTEGER NOT NULL,
	IdI                  INTEGER NOT NULL,
	Naslov               VARCHAR(20) NOT NULL,
	DatumEvaluacije      datetime NOT NULL,
	Sadrzaj              VARCHAR(5000) NOT NULL,
	Popularnost          INTEGER NOT NULL DEFAULT 0
);

ALTER TABLE Ideja
ADD CONSTRAINT XPKIdeja PRIMARY KEY (IdI);

CREATE TABLE Korisnik
(
	IdK                  INTEGER NOT NULL,
	Username             VARCHAR(20) NOT NULL,
	Password             VARCHAR(20) NOT NULL,
	DatumReg             datetime NOT NULL,
	Email                VARCHAR(20) NOT NULL,
	Skor                 DECIMAL(10,2) NOT NULL,
	Popularnost          INTEGER NOT NULL DEFAULT 0
);

ALTER TABLE Korisnik
ADD CONSTRAINT XPKKorisnik PRIMARY KEY (IdK);

CREATE UNIQUE INDEX XAK1Korisnik ON Korisnik
(
	Username ASC
);

CREATE TABLE Moderator
(
	IdM                  INTEGER NOT NULL
);

ALTER TABLE Moderator
ADD CONSTRAINT XPKModerator PRIMARY KEY (IdM);

CREATE TABLE Obican_Ili_Veran
(
	IdK                  INTEGER NOT NULL,
	Veran                boolean NOT NULL
);

ALTER TABLE Obican_Ili_Veran
ADD CONSTRAINT XPKObican_Ili_Veran PRIMARY KEY (IdK);

CREATE TABLE Odgovor_Na
(
	IdP                  INTEGER NOT NULL,
	IdI                  INTEGER NOT NULL
);

ALTER TABLE Odgovor_Na
ADD CONSTRAINT XPKOdgovor_Na PRIMARY KEY (IdP);

CREATE TABLE Predvidjanje
(
	IdK                  INTEGER NOT NULL,
	IdP                  INTEGER NOT NULL,
	Naslov               VARCHAR(20) NOT NULL,
	DatumNastanka        datetime NOT NULL,
	DatumEvaluacije      datetime NOT NULL,
	Sadrzaj              VARCHAR(5000) NOT NULL,
	Nominalna_Tezina     DECIMAL(10,2) NOT NULL,
	Tezina               DECIMAL(10,2) NOT NULL,
	Popularnost          INTEGER NOT NULL DEFAULT 0,
	BrOcena              INTEGER NOT NULL DEFAULT 0
);

ALTER TABLE Predvidjanje
ADD CONSTRAINT XPKPredvidjanje PRIMARY KEY (IdP);

CREATE TABLE Voli
(
	IdK                  INTEGER NOT NULL,
	IdP                  INTEGER NOT NULL
);

ALTER TABLE Voli
ADD CONSTRAINT XPKKorisnik_Predvidjanje_Voli PRIMARY KEY (IdK,IdP);

ALTER TABLE Admin
ADD CONSTRAINT R_4 FOREIGN KEY (IdA) REFERENCES Korisnik (IdK)
		ON DELETE CASCADE;

ALTER TABLE Daje_Ocenu
ADD CONSTRAINT R_19 FOREIGN KEY (IdK) REFERENCES Korisnik (IdK);

ALTER TABLE Daje_Ocenu
ADD CONSTRAINT R_20 FOREIGN KEY (IdP) REFERENCES Predvidjanje (IdP);

ALTER TABLE Ideja
ADD CONSTRAINT R_6 FOREIGN KEY (IdK) REFERENCES Korisnik (IdK);

ALTER TABLE Moderator
ADD CONSTRAINT R_3 FOREIGN KEY (IdM) REFERENCES Korisnik (IdK)
		ON DELETE CASCADE;

ALTER TABLE Obican_Ili_Veran
ADD CONSTRAINT R_1 FOREIGN KEY (IdK) REFERENCES Korisnik (IdK)
		ON DELETE CASCADE;

ALTER TABLE Odgovor_Na
ADD CONSTRAINT R_7 FOREIGN KEY (IdP) REFERENCES Predvidjanje (IdP);

ALTER TABLE Odgovor_Na
ADD CONSTRAINT R_8 FOREIGN KEY (IdI) REFERENCES Ideja (IdI);

ALTER TABLE Predvidjanje
ADD CONSTRAINT R_5 FOREIGN KEY (IdK) REFERENCES Korisnik (IdK);

ALTER TABLE Voli
ADD CONSTRAINT R_16 FOREIGN KEY (IdK) REFERENCES Korisnik (IdK);

ALTER TABLE Voli
ADD CONSTRAINT R_17 FOREIGN KEY (IdP) REFERENCES Predvidjanje (IdP);
