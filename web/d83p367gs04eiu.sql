--::::::::::WRITE SQL HERE::::::::::::
-- GROUP # 7
-- Ronald Munoz
-- Peter Flickinger
-- Matthew LeFevre
--These Tables

/*  USER
  ---------
  user_id
  user_name
  password
*/
  CREATE TABLE "user" (
   user_id    INT                 NOT NULL,
   user_name  VARCHAR(20)            NOT NULL,
   password   VARCHAR(20)            NOT NULL,
   PRIMARY KEY( user_id )
);

INSERT INTO "user" VALUES (001, 'pflick', 'LetMeIn');
INSERT INTO "user" VALUES (002, 'jimmyj', 'LetMeIn');
INSERT INTO "user" VALUES (003, 'pointdext', 'LetMeIn');
/*  Conference
--------------
  conference_id
  conference_date
*/
  CREATE TABLE "conference" (
   conference_id    INT                 NOT NULL,
   conference_date  VARCHAR(20)         NOT NULL,
   PRIMARY KEY( conference_id )
);
INSERT INTO "conference" VALUES (001, 'April 2018');
INSERT INTO "conference" VALUES (002, 'October 2018');
INSERT INTO "conference" VALUES (003, 'April 2017');


/* Speaker
---------------
  speaker_id
  name
*/
CREATE TABLE "speaker" (
   speaker_id    INT                 NOT NULL,
   name          varchar(55)         NOT NULL,
   PRIMARY KEY( speaker_id )
);
INSERT INTO "speaker" VALUES (001, 'President Russel M. Nelson');
INSERT INTO "speaker" VALUES (002, 'President Dallin H. Oaks');
INSERT INTO "speaker" VALUES (003, 'President Henry B. Eyring');


/*  Talks
---------------
  talk_id
  title
  data
  speaker_id
  conference_id
*/
CREATE TABLE "talk" (
     talk_id          INT              NOT NULL,
     title            VARCHAR(20)      NOT NULL,
     speaker_id       INT              NOT NULL,
     conference_id    INT              NOT NULL,
     PRIMARY KEY( talk_id ),
     FOREIGN KEY (speaker_id) REFERENCES speaker(speaker_id),
     FOREIGN KEY (conference_id) REFERENCES conference(conference_id)
  );
INSERT INTO "talk" VALUES (001, 'TEST_TITTLE', 001, 001);
INSERT INTO "talk" VALUES (002, 'TEST_TITTLE_2', 001, 001);
INSERT INTO "talk" VALUES (003, 'TEST_TITTLE_3', 001, 001);

/* Note
---------------
  note_id
  data
  talk_id
*/
  CREATE TABLE "note" (
     note_id    INT              NOT NULL,
     data       varchar(55)      NOT NULL,
     talk_id    INT              NOT NULL,
     PRIMARY KEY( note_id ),
     FOREIGN KEY (talk_id) REFERENCES talk(talk_id)
  );