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
    And I click on "//tbody/tr/td[3]/button[2]" "xpath_element"
    And I press "Confirm"
    Then I should not see "hiep"
    And I log out

  @javascript
  Scenario: Search Alias
    When I log in as "admin"
    And I navigate to "Plugins > Local plugins > Manage Alias" in site administration

    And I press "Create Alias"
    And I set the field "friendly" to "hiep"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"
    And I should see "hiep"

    And I press "Create Alias"
    And I set the field "friendly" to "hao"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"
    And I should see "hao"

    And I set the field "query" to "hie"
    And I press "Go"
    And I should see "hiep"
    And I log out

  @javascript
  Scenario: Paginate Alias
    When I log in as "admin"
    And I navigate to "Plugins > Local plugins > Manage Alias" in site administration

    And I press "Create Alias"
    And I set the field "friendly" to "hiep"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"

    And I press "Create Alias"
    And I set the field "friendly" to "hao"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"

    And I press "Create Alias"
    And I set the field "friendly" to "hieu"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"

    And I press "Create Alias"
    And I set the field "friendly" to "hoa"
    And I set the field "destination" to "nguyen"
    And I press "Save changes"

    And I click on "//div/div/nav/ul/li[2]" "xpath_element"

    And I should see "hiep"
    Then I should not see "hieu"
    Then I should not see "hoa"
    Then I should not see "hao"
    And I log out

