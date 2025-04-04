# Projet Jouer Pour Être Gagnant -- INFO204

> [!NOTE]
> Accès rapide aux parties de la doc.
> - [TODOLIST](./TODO.md)
> - [Ideas](./Ideas.md)


# Table des matières

- [Le groupe](#le-groupe)
- [Le projet](#le-projet)




# Le groupe

Nom : JPEG (Ailes-hein)\
Membres :
- [BELLOT Aline](https://github.com/TheWarior73)
- [GUYON Eddy](https://github.com/synnfall)
- [DELAMEZIÈRE Lucas](https://github.com/bouncii)
- [LONGERET-CHAVANEL Evan](https://github.com/ItsMe-Truncation)

`N° Groupe : 14`


# Le projet

## La base de donnée
```mermaid
---
title: Base de donnée
---

classDiagram
    Utilisateurs <|-- Classement

    class Utilisateurs {
        #Identifiant
        Mdp(VARCHAR = 500 (HASH)
        LienPdp(VARCHAR = 500)
        Datecreation(DATE)
        isAdmin(bool)
    }

    class Jeux {
        #ID
        NomJeux(VARCHAR = 100)
        NbLikes(int)

    }

    class Classement {
        #Id
        id_user
        id_jeux
        pts(int)
        rang(int)
    }
    
    class Parties {
        #id
        joueurs(array)
    }

    %% class historique {
    %% }
```