## INTRODUCTION

The Minial Roll module is a framework to maintain an inventory of wargaming minitures.

The primary use case for this module is:

- Maintain a list of wargaming minitures in your collection.
- Add custom fields to the models for pictures or custom rules.
- Add more custom fields to create a wargaming ruleset.

## REQUIREMENTS

- Views
- Layout Builder

## INSTALLATION

Install as you would normally install a contributed Drupal module.
See: https://www.drupal.org/node/895232 for further information.

## CONFIGURATION
- Custom fields and bundle configuration can be found at: `/admin/structure/minial_roll`
- Content management can be found at `/admin/structure/minial_roll`
- Some views have been created to assist with UX
  - `/minial-roll/games`
  - `/minial-roll/inventory`

## USE

A game is created
- The creation triggers the creation of the following content types
  - Character
  - Armour
  - Faction
  - Weapon
  - Ability
  - Model
- Each of these content types can be used to generate details of a model
- These models can be added to inventories, squads and

## MAINTAINERS

Current maintainers for Drupal 10:

- Bryan Heisler (geekygnr) - https://www.drupal.org/u/geekygnr

