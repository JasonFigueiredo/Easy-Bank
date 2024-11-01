-- Coamndo para inserir usuario
INSERT INTO tb_usuario
(nome_usuario,email_usuario,senha_usuario,data_cadastro)
VALUES 
('Jason','jason123@gmail.com','123456','2024-12-23');

-- Coamndo para inserir categoria
INSERT INTO tb_conta
(banco_conta,agencia_conta,numero_conta,saldo_conta,id_usuario)
VALUES 
('sanatander','0987','1234567-8','123456','1');

SELECT id_categoria,nome_categoria 
FROM tb_categoria
where id_categoria = 1
                    AND id_usuario = 1