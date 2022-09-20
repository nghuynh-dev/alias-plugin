@local_alias
Feature: Manage aliases
  @javascript
  Scenario: Creating Alias
    When I log in as "admin"
    And I navigate to "Plugins > Local plugins > Manage Alias" in site administration

    And I press "Create Alias"
    And I set the field "friendly" to "huynh"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"
    And I should see "huynh"
    And I log out

  @javascript
  Scenario: Edit Alias
    When I log in as "admin"
    And I navigate to "Plugins > Local plugins > Manage Alias" in site administration

    And I press "Create Alias"
    And I set the field "friendly" to "hiep"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"
    And I should see "hiep"
    And I press "Edit"
    And I set the field "friendly" to "edit"
    And I set the field "destination" to "test"
    And I press "Save changes"
    And I should see "test"
    And I log out

  @javascript
  Scenario: Delete Alias
    When I log in as "admin"
    And I navigate to "Plugins > Local plugins > Manage Alias" in site administration

    And I press "Create Alias"
    And I set the field "friendly" to "hiep"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"
    And I should see "hiep"
    And I press "Delete"
    And I press "Confirm"
    Then I should not see "hiep"
    And I log out

