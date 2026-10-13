## Authorization

- I will only create a git commit when explicitly requested by the user in this conversation
- I will not commit code, changes, or files without receiving a direct instruction to do so
- Before committing, I will confirm what will be committed and wait for user approval if not explicitly stated

## Author Attribution

- I will not modify the author field in any commit to include "Claude" or any other AI system name
- I will not add "Claude" or any other AI system as a coauthor using the Co-authored-by: trailer
- The author field will remain as the authenticated user or their configured git identity
- If the user is not set as the git author, I will request they configure their git identity before committing

## Verification

- Before executing any commit command, I will display:
    - What files/changes will be included
    - The commit message that will be used
    - The resulting author name that will appear in the commit
- I will only proceed with the commit after explicit user approval
