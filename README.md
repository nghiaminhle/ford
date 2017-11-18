# ford
This is a simple state machine library used for workflow implementation.

Each state has:

- The name of state

- The transition and condition to other state

- The entry activity, invoked when entry a new state

- the exit activity, invoked when exit a new state

Workflow:

- Has current State

- Has unique id

- Run state machine with activity context
