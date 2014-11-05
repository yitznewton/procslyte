# Group Renderer

From http://citationstyles.org/downloads/specification.html#group

> The `cs:group` rendering element must contain one or more rendering elements (with the exception of `cs:layout`). `cs:group` may carry the delimiter attribute to separate its child elements, as well as affixes and display attributes (applied to the output of the group as a whole) and formatting attributes (transmitted to the enclosed elements). cs:group implicitly acts as a conditional: `cs:group` and its child elements are suppressed if a) at least one rendering element in `cs:group` calls a variable (either directly or via a macro), and b) all variables that are called are empty.

## Craziness

This is one of those cases where we need to make a decision based on something that may happen layers down in the rendering tree, i.e. the intersection of

* the presence of at least one empty variable under the group (which may include variables wrapped in macros)
* the absence of any non-empty variable under the group

## Implementation

We have decided to implement this by having the `VariableRenderer` publish a notification when rendering, based on whether the rendered variable is empty. Any enclosing `MacroRenderer` will propagate those notifications up as both a subscriber and publisher [1], with the final subscriber being the `GroupRenderer`. Based on the composite of those notifications, the decision is made whether to render the group as a whole, or not.

[1] This is a projection; as of this writing, `MacroRenderer` is not yet implemented.