
CREATE TABLE IF NOT EXISTS message
(
    id INTEGER PRIMARY KEY AUTOINCREMENT,
    user VARCHAR(100),
    msg VARCHAR(100)
)

insert into message(user,msg) values ("moibd", "messagebd");
