TimeTrial
=========

CALI Time Trial Card Game

CALI Time Trial is the card game that challenges your knowledge of legal history. Draw a card and fit it into the time line based on the information on the card.
Sound easy?
How much do you know about NLRB vs. Jones & Laughlin Steel Corp.?

To get started just clone the repo into your webtree.


## Data structure for cards

The card data contains the following columns: `ID`, `Title`, `Series`, `Text`, `Date1`, `Date2`, `Appt Pres`, `Case1`, `Case2`, `Case3`, `Citation`. 
`ID` is the original unique card number used on the printed cards. 
All cards have a `Date1` field to determine the correct card ordering in the timeline. 
`Series` is the type of card. This determines which of the subsequent fields are used. 
`Series` types include `Amendment`, `Justice`, `SCt Case`, `Public Law`, `People`, `Documents`, `Treatises`, and `Decade`.

### Amendment
* `Title`: Amendment name
* `Text`: Amendment description
* `Date1`: Year of Amendment
### SCt Case
* `Title`: Case name
* `Text`: Descripton of case
* `Citation`: Case citation
* `Date1`: Date of case
### Justice
* `Title`:  name of the Justice
* `Text`: brief bio
* `Case1`, `Case2`, `Case3`: Well known cases (`Case2` and `Case3` may be empty)
* `Appt Pres`: President when Justice was appointed
* `Date1`, `Date2`: years served on Court
### People
* `Title`:  person name
* `Text`: brief bio
* `Appt Pres`: President during term (optional)
* `Date1`, `Date2`: years served
### Public Law
* `Title`: public law 
* `Text`: description
* `Date1`: publication year
### Decade
* `Title`: decade 
* `Text`: description
* `Date1`: first year of decade
### Documents/Treatises
* `Title`: Document title
* `Text`: description
* `Date1`: publication year

## Setting up score tracking and the leaderboard

