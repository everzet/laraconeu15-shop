Feature: Applying VAT and a delivery costs to the basket
  In order to be more confident in making a purchase
  As a customer
  I need VAT and a cost of delivery to be calculated for my basket

  Rules:
    - VAT is 20%
    - Delivery cost for a basket > £10 is £2
    - Delivery cost for a basket < £10 is £3

  @critical
  Scenario: Product costing less than £10 results in delivery cost of £3
    Given there is a product with SKU "RS1" and a cost of £5 in the catalogue
    When I add the product with SKU "RS1" from the catalogue to my basket
    Then the total cost of my basket should be £9

  Scenario: Product costing more than £10 results in delivery cost of £2
    Given there is a product with SKU "RS2" and a cost of £15 in the catalogue
    When I add the product with SKU "RS2" from the catalogue to my basket
    Then the total cost of my basket should be £20

  Scenario: Product costing exactly £10 results in delivery cost of £3
    Given there is a product with SKU "RS3" and a cost of £10 in the catalogue
    When I add the product with SKU "RS3" from the catalogue to my basket
    Then the total cost of my basket should be £15

  Scenario: Multiple products under £10 with added VAT still result in delivery cost of £3
    Given there is a product with SKU "RS4" and a cost of £4 in the catalogue
    And there is a product with SKU "RS5" and a cost of £5 in the catalogue
    When I add the product with SKU "RS4" from the catalogue to my basket
    And I add the product with SKU "RS5" from the catalogue to my basket
    Then the total cost of my basket should be £13.8
