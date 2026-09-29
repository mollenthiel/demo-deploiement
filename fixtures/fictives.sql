-- Donnees fictives : aucune donnee reelle d'un cote ne va vers l'autre.
INSERT INTO rendez_vous (client, debut) VALUES
  ('Client fictif A', now() + interval '1 day'),
  ('Client fictif B', now() + interval '2 days');
