DROP DATABASE books_for_all;
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

SELECT * FROM livro WHERE isbn_livro = 100002;
SELECT nome FROM editora WHERE isbn_editora = 1;
