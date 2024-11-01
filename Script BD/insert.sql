 -- comando para inserir 
 -- insert into nome_da_tabela (colunas) values (valores)
select * from tb_usuario; 
select * from tb_servico; 
select * from tb_funcionario; 
select * from tb_atendimento; 
 
insert into tb_usuario
(nome_usuario, email_usuario, senha_usuario, data_cadastro)
values
('Peixoto da Bahia','peixoto@gmail.com','peixoto123','2023-11-12');

insert into tb_servico
(tipo_servico, descricao_servico, id_usuario)
values
('Corte','Cortar em estilo MICHAEL JACKSON','2');

insert into tb_funcionario
(nome_funcionario, data_cadastro, data_admissao, id_usuario)
values
('Leoncio Barbeiro','2024-03-10','2022-04-10','2');

insert into tb_atendimento
(valor_atendimento, data_atendimento, desc_atendimento, id_funcionario, id_usuario, id_servico, id_cliente)
values
('150.00','2024-06-12','10.00','1','1','1','1'); tb_cliente