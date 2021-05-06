# Pseudocode

## - For saving dice in Yatzy game

```
BEGIN
    FOR each index and die in the list of unsaved dice
        IF the current die is checked for saving THEN
            ADD current die to a temporary list
        ELSE
            ADD current die to a new list of unsaved dice
        ENDIF
    ENDFOR

    SET the old list of unsaved dice to the new list of unsaved dice

    FOR each index and die in the list of saved dice
        IF the current dice is unchecked THEN
            ADD current die to the list of unsaved dice
        ELSE
            ADD current die to a new list of saved dice
        ENDIF
    ENDFOR

    SET the old list of saved dice to the new list of saved dice

    FOR each die in the list of temporary dice
        ADD current die to the list of saved dice
END
```
