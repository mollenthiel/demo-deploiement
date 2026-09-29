-- Ajout d'une colonne avec valeur par defaut : l'ancienne version, qui l'ignore, continue de marcher.
ALTER TABLE rendez_vous ADD COLUMN duree_minutes integer NOT NULL DEFAULT 60;
