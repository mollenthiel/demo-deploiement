-- Ajout seul : compatible avec la version precedente du code.
CREATE TABLE rendez_vous (
    id serial PRIMARY KEY,
    client text NOT NULL,
    debut timestamptz NOT NULL
);
