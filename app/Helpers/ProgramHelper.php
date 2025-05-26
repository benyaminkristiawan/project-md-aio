// app/Helpers/program_helper.php
if (!function_exists('getProgramMarketplaces')) {
function getProgramMarketplaces($programId)
{
$db = \Config\Database::connect();
return $db->table('program_marketplaces')
->join('marketplaces', 'marketplaces.id = program_marketplaces.marketplace_id')
->where('program_id', $programId)
->get()
->getResult();
}
}

if (!function_exists('getProgramSalesTeams')) {
function getProgramSalesTeams($programId)
{
$db = \Config\Database::connect();
return $db->table('program_sales_teams')
->join('sales_team', 'sales_team.id = program_sales_teams.sales_team_id')
->where('program_id', $programId)
->get()
->getResult();
}
}

if (!function_exists('getBrandName')) {
function getBrandName($brandId)
{
$db = \Config\Database::connect();
$brand = $db->table('brands')
->select('name')
->where('id', $brandId)
->get()
->getRow();
return $brand->name ?? '-';
}
}

if (!function_exists('getRewardName')) {
function getRewardName($rewardId)
{
$db = \Config\Database::connect();
$reward = $db->table('rewards')
->select('name')
->where('id', $rewardId)
->get()
->getRow();
return $reward->name ?? '-';
}
}