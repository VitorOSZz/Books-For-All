
DROP DATABASE IF EXISTS books_for_all;
CREATE DATABASE books_for_all;

USE books_for_all;

CREATE TABLE editora(
	isbn_editora INT(7) PRIMARY KEY, 
	nome VARCHAR(50) NOT NULL UNIQUE, 
    cnpj CHAR(18) NOT NULL UNIQUE, 
    pais VARCHAR(50) NOT NULL, 
    email VARCHAR(100) NOT NULL UNIQUE,
    senha VARCHAR(50) NOT NULL
    );
    
CREATE TABLE livro(
	isbn_livro INT(6) primary key,
    nome VARCHAR(50) NOT NULL UNIQUE,
    num_pag INT NOT NULL,
    num_curtidas INT NOT NULL DEFAULT 0,
    sinopse VARCHAR(300) NOT NULL,
    endereco_capa VARCHAR(100) NOT NULL UNIQUE,
    endereco_conteudo VARCHAR(100) NOT NULL UNIQUE,
    isbn_editora INT(7),
    FOREIGN KEY(isbn_editora) REFERENCES editora(isbn_editora)
	);
    
CREATE TABLE autor(
	id_autor INT PRIMARY KEY AUTO_INCREMENT,
	nome_autor VARCHAR(50) NOT NULL,
    isbn_livro INT(6),
    FOREIGN KEY(isbn_livro) REFERENCES livro (isbn_livro)
    );
   
CREATE TABLE usuario(
	id_usuario INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL UNIQUE,
    is_adm BOOL NOT NULL DEFAULT FALSE,
    email VARCHAR(100) UNIQUE,
    telefone VARCHAR(18) UNIQUE,
    data_nasc DATE,
    senha VARCHAR(50) NOT NULL
    );

CREATE TABLE lista (
	id_lista INT PRIMARY KEY AUTO_INCREMENT,
    nome VARCHAR(50) NOT NULL,
    id_usuario INT,
    FOREIGN KEY (id_usuario) REFERENCES usuario(id_usuario)
    );

CREATE TABLE livro_lista (
	id_lista INT,
    isbn_livro INT(6),
    PRIMARY KEY(id_lista, isbn_livro),
    FOREIGN KEY (id_lista) REFERENCES lista(id_lista),
    FOREIGN KEY (isbn_livro) REFERENCES livro(isbn_livro)
    );

CREATE TABLE usuario_livro (
	isbn_livro INT(6),
    id_usuario INT,
    curtida BOOL NOT NULL DEFAULT FALSE,
    pagina INT,
    PRIMARY KEY (isbn_livro, id_usuario),
    FOREIGN KEY (isbn_livro) REFERENCES livro (isbn_livro),
    FOREIGN KEY (id_usuario) REFERENCES usuario (id_usuario)
    );

-- DML --

INSERT INTO editora 
VALUES (1, 'books for all', '14.421.656/0001-92', 'Brasil', 'booksforall@gmail.com','booksPassword');

INSERT INTO editora
VALUES (2, 'Editora GER', '38.702.634/0001-69', 'Alemanha', 'EdiGER@gmail.com','Germany');

INSERT INTO editora
VALUES (3, 'Slavs Editora', '27.637.497/0001-00', 'Servia', 'Yugoslavia@hotmail.com','tito');

INSERT INTO editora
VALUES (4, "Benaci's books", '07.953.178/0001-04', 'Brasil', 'BenassiHotDogs@outlook.com', 'Hotdogs');

INSERT INTO editora
VALUES (5, "NCR Libary", '18.113.024/0001-12', 'Estados Unidos', 'HoverDam@nukacola.com', 'longlivecalifornia');

INSERT INTO editora
VALUES (6, 'Silly books', '21.522.226/0001-22', 'Brasil', 'silliest@gmail.com', 'silly of the sillies');

INSERT INTO livro (
    isbn_livro,
    nome,
    num_pag,
    num_curtidas,
    sinopse,
    endereco_capa,
    endereco_conteudo,
    isbn_editora
	) 
VALUES (
    100001,
    'Nada de novo no front',
    300,
    0,
    'A história de jovens soldados alemães que enfrentam os horrores da Primeira Guerra Mundial.',
    'src/Capa books for All/Nada de novo no front.png',
    'src/Livros books for all/Nada de novo no front.pdf',
    1
),
(
    100002,
    'Diario de Anne Frank',
    350,
    0,
    'O diário de Anne Frank relata a vida de uma jovem judia escondida durante a Segunda Guerra Mundial.',
    'src/Capa books for All/Diario de Anne Frank.png',
    'src/Livros books for all/Diario de Anne Frank.pdf',
    1
),
(
    100003,
    'Vinte mil leguas submarinas',
    250,
    0,
    'Uma aventura de Júlio Verne que acompanha uma expedição submarina a bordo do Nautilus.',
    'src/Capa books for All/Vinte mil leguas submarinas.png',
    'src/Livros books for all/Vinte mil leguas submarinas.pdf',
    1
),
(
    100004,
    'Arte da guerra',
    100,
    0,
    'Uma obra clássica de Sun Tzu sobre estratégia militar, planejamento e liderança.',
    'src/Capa books for All/A Arte da guerra.png',
    'src/Livros books for all/A Arte da guerra.pdf',
    1
),
(
    100005,
    'A metamorfose',
    100,
    0,
    'A narrativa de Franz Kafka sobre Gregor Samsa, que acorda transformado em uma criatura monstruosa.',
    'src/Capa books for All/A metamorfose.png',
    'src/Livros books for all/A metamorfose.pdf',
    1
),
(
    100006,
    'A revolucao dos bichos',
    150,
    0,
    'Uma fábula de George Orwell que critica o autoritarismo e a corrupção do poder por meio de uma revolta de animais.',
    'src/Capa books for All/A revolucao dos bichos.png',
    'src/Livros books for all/A revolucao dos bichos.pdf',
    1
);

INSERT INTO usuario
	(
    nome,
    is_adm,
    email,
    telefone,
    data_nasc,
    senha
	)
 VALUES
	(
	"Marks DJ.", 
    TRUE, 
    "dj.marks_sampleydeguitarra@gmail.com", 
    "+55 55 98090-6915",
	"0200-10-10",
    "tarn-ra-ra-ran"
    ),
    
    (
	"kaulMarks DJ.", 
    TRUE, 
    "dr.marks_criticadeguitarra@gmail.com", 
    "+55 44 96835-4338",
    "1900-03-10",
    "ploritariado0n_top"
    ),
    
    (
	"Chorando de Prazer", 
    FALSE, 
    "dor_to_plassure@gmail.com", 
    "+55 27 92279-3002",
    "2020-01-20",
    "cred0_que_delicia"
    ),
    
    (
	"O pensador", 
    FALSE, 
    "feel_osofo@gmail.com", 
    "+55 24 7357-6151",
    "0500-10-20",
    "Pens0_logo_entro"
    ),
    
    (
	"DR.direito", 
    TRUE, 
    "Doutor@gmail.com", 
    "+55 33 96618-0632",
    "2020-11-21",
    "Im_the_law"
    ),
    
	(
	"Colica Slayer", 
    FALSE, 
    "sensivel_1.80_musico@gmail.com", 
    "+55 64 98993-5551",
    "2007-11-26",
    "AgrSoEsperar_67"
    );

INSERT INTO autor(nome_autor, isbn_livro)
VALUES 
	('Erich Maria Remarque', 100001),
	('Anne Frank', 100002),
    ('Júlio Verne', 100003),
    ('Sun Tzu', 100004),
    ('Franz Kafka', 100005),
    ('George Orwell', 100006);

INSERT INTO lista (nome, id_usuario)
VALUES 
('Favoritos', 1),
('Favoritos', 2),
('Favoritos', 3),
('Favoritos', 4),
('Favoritos', 5),
('Favoritos', 6);

INSERT INTO livro_lista (id_lista, isbn_livro)
VALUES 
(1, 100004), 
(1, 100003),
(2, 100001),
(2, 100005),
(4, 100006),
(4, 100002),
(4, 100004),
(6, 100005);

INSERT INTO usuario_livro (id_usuario, isbn_livro, curtida, pagina)
VALUES 
	(1, 100004, TRUE, 32),
    (1, 100003, FALSE, 50),
	(2, 100001, FALSE, 67),
	(2, 100005, TRUE, 10),
	(4, 100006, TRUE, 6),
	(4, 100002, TRUE, 3),
	(4, 100004, TRUE, 1),
	(6, 100005, FALSE , 89);
	
-- DQL --

ALTER TABLE livro
ADD COLUMN genero VARCHAR(50),
ADD COLUMN data_lancamento DATE;

UPDATE livro
SET genero = 'Romance',
    data_lancamento = '1929-01-31'
WHERE isbn_livro = 100001;

UPDATE livro
SET genero = 'Autobiografia',
    data_lancamento = '1947-06-25'
WHERE isbn_livro = 100002;

UPDATE livro
SET genero = 'Ficção científica',
    data_lancamento = '1870-11-28'
WHERE isbn_livro = 100003;

UPDATE livro
SET genero = 'Filosofia',
    data_lancamento = NULL
WHERE isbn_livro = 100004;

UPDATE livro
SET genero = 'Fantasia',
    data_lancamento = '1915-10-01'
WHERE isbn_livro = 100005;

UPDATE livro
SET genero = 'Ficção política',
    data_lancamento = '1945-08-17'
WHERE isbn_livro = 100006;

INSERT INTO livro (
    isbn_livro,
    nome,
    num_pag,
    num_curtidas,
    sinopse,
    endereco_capa,
    endereco_conteudo,
    isbn_editora
)
VALUES
(
    100007,
    'Ainda estou aqui',
    296,
    0,
    'Relato autobiográfico de Marcelo Rubens Paiva sobre sua família e a história de seu pai durante a ditadura militar brasileira.',
    'src/Capa books for All/Ainda estou aqui.png',
    'src/Livros books for all/Ainda estou aqui.pdf',
    1
),
(
    100008,
    'Dracula',
    418,
    0,
    'Um clássico de Bram Stoker que narra a história do Conde Drácula e sua tentativa de espalhar seu domínio para a Inglaterra.',
    'src/Capa books for All/Dracula.png',
    'src/Livros books for all/Dracula.pdf',
    1
),
(
    100009,
    'O Picapau Amarelo',
    192,
    0,
    'Uma aventura do universo do Sítio do Picapau Amarelo, criado por Monteiro Lobato.',
    'src/Capa books for All/O Picapau Amarelo.png',
    'src/Livros books for all/O Picapau Amarelo.pdf',
    1
),
(
    100010,
    'Vidas secas',
    176,
    0,
    'A história de uma família de retirantes que enfrenta a seca, a pobreza e as dificuldades da vida no sertão nordestino.',
    'src/Capa books for All/Vidas secas.png',
    'src/Livros books for all/Vidas secas.pdf',
    1
),
(
    100011,
    'Alice no pais das maravilhas',
    160,
    0,
    'Uma menina chamada Alice entra em um mundo fantástico onde encontra personagens extraordinários e vive aventuras inesperadas.',
    'src/Capa books for All/Alice no pais das maravilhas.png',
    'src/Livros books for all/Alice no pais das maravilhas.pdf',
    1
),
(
    100012,
    'Frankenstein',
    280,
    0,
    'A história de Victor Frankenstein, um cientista que cria uma criatura artificial e enfrenta as consequências de sua experiência.',
    'src/Capa books for All/Frankenstein.png',
    'src/Livros books for all/Frankenstein.pdf',
    1
),
(
    100013,
    'O morro dos ventos uivantes',
    416,
    0,
    'Um romance de Emily Brontë que apresenta uma intensa história de amor, vingança e conflitos familiares.',
    'src/Capa books for All/O morro dos ventos uivantes.png',
    'src/Livros books for all/O morro dos ventos uivantes.pdf',
    1
),
(
    100014,
    'Orgulho e preconceito',
    432,
    0,
    'Um romance de Jane Austen que aborda relacionamentos, diferenças sociais, orgulho e preconceito na sociedade inglesa.',
    'src/Capa books for All/Orgulho e preconceito.png',
    'src/Livros books for all/Orgulho e preconceito.pdf',
    1
),
(
    100015,
    'A volta ao mundo em 80 dias',
    240,
    0,
    'Phileas Fogg aceita o desafio de dar a volta ao mundo em apenas oitenta dias, vivendo diversas aventuras pelo caminho.',
    'src/Capa books for All/A volta ao mundo em 80 dias.png',
    'src/Livros books for all/A volta ao mundo em 80 dias.pdf',
    1
),
(
    100016,
    'Hamlet',
    200,
    0,
    'Uma tragédia de William Shakespeare sobre um príncipe que busca vingança pela morte de seu pai.',
    'src/Capa books for All/Hamlet.png',
    'src/Livros books for all/Hamlet.pdf',
    1
),
(
    100017,
    'O pequeno principe',
    96,
    0,
    'Um pequeno príncipe viaja por diferentes planetas e descobre importantes lições sobre amizade, amor e a vida.',
    'src/Capa books for All/O pequeno principe.png',
    'src/Livros books for all/O pequeno principe.pdf',
    1
),
(
    100018,
    'Romeu e Julieta',
    160,
    0,
    'Uma tragédia de William Shakespeare sobre dois jovens apaixonados que pertencem a famílias rivais.',
    'src/Capa books for All/Romeu e Julieta.png',
    'src/Livros books for all/Romeu e Julieta.pdf',
    1
),
(
    100019,
    '12 anos de escravidão',
    352,
    0,
    'A autobiografia de Solomon Northup, um homem negro livre que foi sequestrado e vendido como escravo nos Estados Unidos.',
    'src/Capa books for All/12 anos de escravidão.png',
    'src/Livros books for all/12 anos de escravidão.pdf',
    1
);
UPDATE livro
SET endereco_conteudo = CASE isbn_livro

    WHEN 100001 THEN 'src/Livros Book for All/Nada de novo no front.pdf'
    WHEN 100002 THEN 'src/Livros Book for All/Diario de Anne Frank.pdf'
    WHEN 100003 THEN 'src/Livros Book for All/Vinte mil leguas submarinas.pdf'
    WHEN 100004 THEN 'src/Livros Book for All/A Arte da guerra.pdf'
    WHEN 100005 THEN 'src/Livros Book for All/A metamorfose.pdf'
    WHEN 100006 THEN 'src/Livros Book for All/A revolucao dos bichos.pdf'
    WHEN 100007 THEN 'src/Livros Book for All/Ainda estou aqui.pdf'
    WHEN 100008 THEN 'src/Livros Book for All/Dracula.pdf'
    WHEN 100009 THEN 'src/Livros Book for All/O Picapau Amarelo.pdf'
    WHEN 100010 THEN 'src/Livros Book for All/Vidas secas.pdf'
    WHEN 100011 THEN 'src/Livros Book for All/Alice no pais das maravilhas.pdf'
    WHEN 100012 THEN 'src/Livros Book for All/Frankenstein.pdf'
    WHEN 100013 THEN 'src/Livros Book for All/O morro dos ventos uivantes.pdf'
    WHEN 100014 THEN 'src/Livros Book for All/Orgulho e preconceito.pdf'
    WHEN 100015 THEN 'src/Livros Book for All/A volta ao mundo em 80 dias.pdf'
    WHEN 100016 THEN 'src/Livros Book for All/Hamlet.pdf'
    WHEN 100017 THEN 'src/Livros Book for All/O pequeno principe.pdf'
    WHEN 100018 THEN 'src/Livros Book for All/Romeu e Julieta.pdf'
    WHEN 100019 THEN 'src/Livros Book for All/12 anos de escravidao.pdf'

END
WHERE isbn_livro BETWEEN 100001 AND 100019;

SELECT * FRom livro;