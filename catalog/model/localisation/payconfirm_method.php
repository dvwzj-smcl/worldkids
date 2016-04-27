<?php
class ModelLocalisationPayconfirmMethod extends Model {
	public function addPayconfirmMethod($data) {
		foreach ($data['payconfirm_method'] as $language_id => $value) {
			if (isset($payconfirm_method_id)) {
				$this->db->query("INSERT INTO " . DB_PREFIX . "payconfirm_method SET payconfirm_method_id = '" . (int)$payconfirm_method_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
			} else {
				$this->db->query("INSERT INTO " . DB_PREFIX . "payconfirm_method SET language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");

				$payconfirm_method_id = $this->db->getLastId();
			}
		}

		$this->cache->delete('payconfirm_method');
	}

	public function editPayconfirmMethod($payconfirm_method_id, $data) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "payconfirm_method WHERE payconfirm_method_id = '" . (int)$payconfirm_method_id . "'");

		foreach ($data['payconfirm_method'] as $language_id => $value) {
			$this->db->query("INSERT INTO " . DB_PREFIX . "payconfirm_method SET payconfirm_method_id = '" . (int)$payconfirm_method_id . "', language_id = '" . (int)$language_id . "', name = '" . $this->db->escape($value['name']) . "'");
		}

		$this->cache->delete('payconfirm_method');
	}

	public function deletePayconfirmMethod($payconfirm_method_id) {
		$this->db->query("DELETE FROM " . DB_PREFIX . "payconfirm_method WHERE payconfirm_method_id = '" . (int)$payconfirm_method_id . "'");

		$this->cache->delete('payconfirm_method');
	}

	public function getPayconfirmMethod($payconfirm_method_id) {
		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "payconfirm_method WHERE payconfirm_method_id = '" . (int)$payconfirm_method_id . "' AND language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row;
	}

	public function getPayconfirmMethods($data = array()) {
		if ($data) {
			$sql = "SELECT * FROM " . DB_PREFIX . "payconfirm_method WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'";

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
			$payconfirm_method_data = $this->cache->get('payconfirm_method.' . (int)$this->config->get('config_language_id'));

			if (!$payconfirm_method_data) {
				$query = $this->db->query("SELECT payconfirm_method_id, name FROM " . DB_PREFIX . "payconfirm_method WHERE language_id = '" . (int)$this->config->get('config_language_id') . "' ORDER BY name");

				$payconfirm_method_data = $query->rows;

				$this->cache->set('payconfirm_method.' . (int)$this->config->get('config_language_id'), $payconfirm_method_data);
			}

			return $payconfirm_method_data;
		}
	}

	public function getPayconfirmMethodDescriptions($payconfirm_method_id) {
		$payconfirm_method_data = array();

		$query = $this->db->query("SELECT * FROM " . DB_PREFIX . "payconfirm_method WHERE payconfirm_method_id = '" . (int)$payconfirm_method_id . "'");

		foreach ($query->rows as $result) {
			$payconfirm_method_data[$result['language_id']] = array('name' => $result['name']);
		}

		return $payconfirm_method_data;
	}

	public function getTotalPayconfirmMethods() {
		$query = $this->db->query("SELECT COUNT(*) AS total FROM " . DB_PREFIX . "payconfirm_method WHERE language_id = '" . (int)$this->config->get('config_language_id') . "'");

		return $query->row['total'];
	}
}
