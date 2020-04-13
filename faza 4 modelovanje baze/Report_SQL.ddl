
CREATE TABLE [Admin]
( 
	[IdA]                integer  NOT NULL 
)
go

ALTER TABLE [Admin]
	ADD CONSTRAINT [XPKAdmin] PRIMARY KEY  CLUSTERED ([IdA] ASC)
go

CREATE TABLE [Daje_Ocenu]
( 
	[IdK]                integer  NOT NULL ,
	[IdP]                integer  NOT NULL ,
	[Ocena]              decimal(10,2)  NULL 
)
go

ALTER TABLE [Daje_Ocenu]
	ADD CONSTRAINT [XPKKorisnik_Predvidjanje_Ocena] PRIMARY KEY  CLUSTERED ([IdK] ASC,[IdP] ASC)
go

CREATE TABLE [Ideja]
( 
	[IdK]                integer  NOT NULL ,
	[IdI]                integer  IDENTITY  NOT NULL ,
	[Naslov]             varchar(20)  NOT NULL ,
	[DatumEvaluacije]    datetime  NOT NULL ,
	[Sadrzaj]            varchar(20)  NOT NULL ,
	[Popularnost]        decimal(10,2)  NOT NULL 
	CONSTRAINT [Default_Value_322_589572662]
		 DEFAULT  0
)
go

ALTER TABLE [Ideja]
	ADD CONSTRAINT [XPKIdeja] PRIMARY KEY  CLUSTERED ([IdI] ASC)
go

CREATE TABLE [Korisnik]
( 
	[IdK]                integer  IDENTITY  NOT NULL ,
	[Username]           varchar(20)  NOT NULL ,
	[Password]           varchar(20)  NOT NULL ,
	[DatumReg]           datetime  NOT NULL ,
	[Email]              varchar(20)  NOT NULL ,
	[Skor]               decimal(10,2)  NOT NULL ,
	[Popularnost]        decimal(10,2)  NOT NULL 
)
go

ALTER TABLE [Korisnik]
	ADD CONSTRAINT [XPKKorisnik] PRIMARY KEY  CLUSTERED ([IdK] ASC)
go

ALTER TABLE [Korisnik]
	ADD CONSTRAINT [XAK1Korisnik] UNIQUE ([Username]  ASC)
go

CREATE TABLE [Moderator]
( 
	[IdM]                integer  NOT NULL 
)
go

ALTER TABLE [Moderator]
	ADD CONSTRAINT [XPKModerator] PRIMARY KEY  CLUSTERED ([IdM] ASC)
go

CREATE TABLE [Obican_Ili_Veran]
( 
	[IdK]                integer  NOT NULL ,
	[Veran]              bit  NOT NULL 
)
go

ALTER TABLE [Obican_Ili_Veran]
	ADD CONSTRAINT [XPKObican_Ili_Veran] PRIMARY KEY  CLUSTERED ([IdK] ASC)
go

CREATE TABLE [Odgovor_Na]
( 
	[IdP]                integer  NOT NULL ,
	[IdI]                integer  NOT NULL 
)
go

ALTER TABLE [Odgovor_Na]
	ADD CONSTRAINT [XPKOdgovor_Na] PRIMARY KEY  CLUSTERED ([IdP] ASC)
go

CREATE TABLE [Predvidjanje]
( 
	[IdK]                integer  NOT NULL ,
	[IdP]                integer  IDENTITY  NOT NULL ,
	[Naslov]             varchar(20)  NOT NULL ,
	[DatumNastanka]      datetime  NOT NULL ,
	[DatumEvaluacije]    datetime  NOT NULL ,
	[Sadrzaj]            varchar(20)  NOT NULL ,
	[Nominalna_Tezina]   decimal(10,2)  NOT NULL ,
	[Tezina]             decimal(10,2)  NOT NULL ,
	[Popularnost]        decimal(10,2)  NOT NULL 
	CONSTRAINT [Default_Value_320_418843715]
		 DEFAULT  0,
	[BrOcena]            integer  NOT NULL 
	CONSTRAINT [Default_Value_361_1655001406]
		 DEFAULT  0
)
go

ALTER TABLE [Predvidjanje]
	ADD CONSTRAINT [XPKPredvidjanje] PRIMARY KEY  CLUSTERED ([IdP] ASC)
go

CREATE TABLE [Voli]
( 
	[IdK]                integer  NOT NULL ,
	[IdP]                integer  NOT NULL 
)
go

ALTER TABLE [Voli]
	ADD CONSTRAINT [XPKKorisnik_Predvidjanje_Voli] PRIMARY KEY  CLUSTERED ([IdK] ASC,[IdP] ASC)
go


ALTER TABLE [Admin]
	ADD CONSTRAINT [R_4] FOREIGN KEY ([IdA]) REFERENCES [Korisnik]([IdK])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Daje_Ocenu]
	ADD CONSTRAINT [R_19] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Daje_Ocenu]
	ADD CONSTRAINT [R_20] FOREIGN KEY ([IdP]) REFERENCES [Predvidjanje]([IdP])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Ideja]
	ADD CONSTRAINT [R_6] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Moderator]
	ADD CONSTRAINT [R_3] FOREIGN KEY ([IdM]) REFERENCES [Korisnik]([IdK])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Obican_Ili_Veran]
	ADD CONSTRAINT [R_1] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE CASCADE
		ON UPDATE CASCADE
go


ALTER TABLE [Odgovor_Na]
	ADD CONSTRAINT [R_7] FOREIGN KEY ([IdP]) REFERENCES [Predvidjanje]([IdP])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Odgovor_Na]
	ADD CONSTRAINT [R_8] FOREIGN KEY ([IdI]) REFERENCES [Ideja]([IdI])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Predvidjanje]
	ADD CONSTRAINT [R_5] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go


ALTER TABLE [Voli]
	ADD CONSTRAINT [R_16] FOREIGN KEY ([IdK]) REFERENCES [Korisnik]([IdK])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go

ALTER TABLE [Voli]
	ADD CONSTRAINT [R_17] FOREIGN KEY ([IdP]) REFERENCES [Predvidjanje]([IdP])
		ON DELETE NO ACTION
		ON UPDATE NO ACTION
go
