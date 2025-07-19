--
-- PostgreSQL database dump
--

-- Dumped from database version 17.4
-- Dumped by pg_dump version 17.4

SET statement_timeout = 0;
SET lock_timeout = 0;
SET idle_in_transaction_session_timeout = 0;
SET transaction_timeout = 0;
SET client_encoding = 'UTF8';
SET standard_conforming_strings = on;
SELECT pg_catalog.set_config('search_path', '', false);
SET check_function_bodies = false;
SET xmloption = content;
SET client_min_messages = warning;
SET row_security = off;

--
-- Name: usuarios_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.usuarios_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.usuarios_id_seq OWNER TO postgres;

SET default_tablespace = '';

SET default_table_access_method = heap;

--
-- Name: discos; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.discos (
    id integer DEFAULT nextval('public.usuarios_id_seq'::regclass) NOT NULL,
    nome character varying(50) NOT NULL,
    autor character varying(50) NOT NULL,
    ano integer NOT NULL,
    qtd integer NOT NULL,
    numerofaixas integer,
    audio bytea,
    gravadora character varying(255)
);


ALTER TABLE public.discos OWNER TO postgres;

--
-- Name: livros; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.livros (
    id integer DEFAULT nextval('public.usuarios_id_seq'::regclass) NOT NULL,
    nome character varying(50) NOT NULL,
    autor character varying NOT NULL,
    ano integer NOT NULL,
    qtd integer NOT NULL,
    editora character varying(255),
    numeropaginas integer,
    imagem bytea
);


ALTER TABLE public.livros OWNER TO postgres;

--
-- Name: user_id_seq; Type: SEQUENCE; Schema: public; Owner: postgres
--

CREATE SEQUENCE public.user_id_seq
    START WITH 1
    INCREMENT BY 1
    NO MINVALUE
    NO MAXVALUE
    CACHE 1;


ALTER SEQUENCE public.user_id_seq OWNER TO postgres;

--
-- Name: usuarios; Type: TABLE; Schema: public; Owner: postgres
--

CREATE TABLE public.usuarios (
    id integer DEFAULT nextval('public.user_id_seq'::regclass) NOT NULL,
    nome character varying(50) NOT NULL,
    cpf character varying(14) NOT NULL,
    email character varying(100) NOT NULL,
    senha text NOT NULL
);


ALTER TABLE public.usuarios OWNER TO postgres;

--
-- Name: discos discos_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.discos
    ADD CONSTRAINT discos_pkey PRIMARY KEY (id);


--
-- Name: livros livros_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.livros
    ADD CONSTRAINT livros_pkey PRIMARY KEY (id);


--
-- Name: usuarios usuarios_pkey; Type: CONSTRAINT; Schema: public; Owner: postgres
--

ALTER TABLE ONLY public.usuarios
    ADD CONSTRAINT usuarios_pkey PRIMARY KEY (id);


--
-- PostgreSQL database dump complete
--

