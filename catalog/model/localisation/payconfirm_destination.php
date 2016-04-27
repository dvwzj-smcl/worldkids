<?php
class ModelLocalisationPayconfirmDestination extends Model {
	public function addPayconfirmDestination($data) {
		foreach ($data['payconfirm_destination'] as $language_id => $value) {
			if (isset($payconfirm_destination_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "payconfirm_destination SET payconfirm_destination_id = '" . (int)$payconfirm_destination_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "payconfirm_destination SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$payconfirm_destination_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('payconfirm_destination');
	}

	public function editPayconfirmDestination($payconfirm_destination_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "payconfirm_destination WHERE payconfirm_destination_id = '" . (int)$payconfirm_destination_id . "'");

		foreach ($data['payconfirm_destination'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "payconfirm_destination SET payconfirm_destination_id = '" . (int)$payconfirm_destination_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('payconfirm_destination');
	}

	public function deletePayconfirmDestination($payconfirm_destination_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "payconfirm_destination WHERE payconfirm_destination_id = '" . (int)$payconfirm_destination_id . "'");

		$this->cache->delete('payconfirm_destination');
	}

	public function getPayconfirmDestination($payconfirm_destination_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "payconfirm_destination WHERE payconfirm_destination_id = '" . (int)$payconfirm_destination_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPayconfirmDestinations($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "payconfirm_destination WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

			$sql .= " ORDER BY name";

			if (isset($data['return']) && ($data['return'] == 'DESC')) {
				$sql .= " DESC";
			} else {
				$sql .= " ASC";
			}

			if (isset($data['start']) || isset($data['limit'])) {
				if ($data['start'] < 0) {
					$data['start'] = 0;
				}

				if ($data['limit'] < 1) {
					$data['limit'] = 20;
				}

				$sql .= " LIMIT " . (int)$data['start'] . "," . (int)$data['limit'];
			}

			$query = $this->db->query($sql);

			return $query->rows;
		} else {
			$payconfirm_destination_data = $this->cache->get('payconfirm_destination.' . (int)$this->config->get('config_language_id'));

			if (!$payconfirm_destination_data) {
				$query = $this->db->query("SELECT payconfirm_destination_id, name FROM " . DB_PREFIX . "payconfirm_destination WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$payconfirm_destination_data = $query->rows;

				$this->cache->set('payconfirm_destination.' . (int)$this->config->get('config_language_id'), $payconfirm_destination_data);
			}

			return $payconfirm_destination_data;
		}
	}

	public function getPayconfirmDestinationDescriptions($payconfirm_destination_id) {
		$payconfirm_destination_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "payconfirm_destination WHERE payconfirm_destination_id = '" . (int)$payconfirm_destination_id . "'");

		foreach ($query->rows as $result) {
			$payconfirm_destination_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $payconfirm_destination_data;
	}

	public function getTotalPayconfirmDestinations() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "payconfirm_destination WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}
